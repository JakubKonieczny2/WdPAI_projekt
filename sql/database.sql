-- Tworzenie bazy danych
CREATE DATABASE system_rezerwacji;

\c system_rezerwacji;
s
-- Tworzenie tabeli użytkowników
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL CHECK (role IN ('patient', 'doctor', 'admin'))
);

-- Tworzenie tabeli wizyt
CREATE TABLE appointments (
    id SERIAL PRIMARY KEY,
    doctor_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    patient_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status VARCHAR(20) NOT NULL CHECK (status IN ('reserved', 'available'))
);

-- Tworzenie tabeli lekarzy
CREATE TABLE doctors (
    user_id INTEGER REFERENCES users(id) PRIMARY KEY,
    specialization VARCHAR(100) NOT NULL
);

CREATE VIEW available_appointments AS
SELECT a.id, u.first_name || ' ' || u.last_name AS doctor_name, d.specialization, a.appointment_date, a.appointment_time
FROM appointments a
JOIN users u ON a.doctor_id = u.id
JOIN doctors d ON u.id = d.user_id
WHERE a.status = 'available';

CREATE VIEW reserved_appointments AS
SELECT a.id, u.first_name || ' ' || u.last_name AS doctor_name, d.specialization, a.appointment_date, a.appointment_time
FROM appointments a
JOIN users u ON a.doctor_id = u.id
JOIN doctors d ON u.id = d.user_id
WHERE a.status = 'reserved';

CREATE OR REPLACE FUNCTION set_default_role() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.role IS NULL THEN
        NEW.role := 'patient';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER set_default_role_trigger
    BEFORE INSERT ON users
    FOR EACH ROW
    EXECUTE FUNCTION set_default_role();

CREATE OR REPLACE FUNCTION check_appointment_availability(doctor_id INTEGER, appointment_date DATE, appointment_time TIME) RETURNS BOOLEAN AS $$
DECLARE
    availability INTEGER;
BEGIN
    SELECT COUNT(*) INTO availability
    FROM appointments
    WHERE doctor_id = doctor_id
    AND appointment_date = appointment_date
    AND appointment_time = appointment_time
    AND status = 'reserved';
    
    IF availability > 0 THEN
        RETURN FALSE;
    ELSE
        RETURN TRUE;
    END IF;
END;
$$ LANGUAGE plpgsql;

-- Przykładowe dane:
-- Hasła są haszowane (użyto bcrypt z kosztem 12)
INSERT INTO users (first_name, last_name, email, password, role)
VALUES
    ('Jan', 'Kowalski', 'jan@mail.com', '$2a$12$Rk6jojTPdeQS2krnJWFtE.ILwin1W8belofLpIG4lyeN1N02oJloC', 'patient'), -- hasło: "password"
    ('Kuba', 'Nowak', 'kuba@mail.com', '$2a$12$Rk6jojTPdeQS2krnJWFtE.ILwin1W8belofLpIG4lyeN1N02oJloC', 'doctor'),   -- hasło: "password"
    ('admin', 'admin', 'admin@mail.com', '$2a$12$YpQ2fWIGsQAbDV/ZZTD9xetvpN4HMTowwvmJPmSpAc6H5Vs3D2EQa', 'admin');   -- hasło: "admin"

-- Dodanie lekarza do tabeli doctors
INSERT INTO doctors (user_id, specialization)
VALUES
    (2, 'Kardiolog');

-- Przykładowe dostępne wizyty
INSERT INTO appointments (doctor_id, patient_id, appointment_date, appointment_time, status)
VALUES
    (2, NULL, '2025-02-15', '09:00:00', 'available'),
    (2, NULL, '2025-02-15', '11:00:00', 'available');