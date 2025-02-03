# System Rezerwacji Wizyt u Lekarza

## Opis projektu
System Rezerwacji Wizyt u Lekarza to aplikacja internetowa umożliwiająca pacjentom rezerwację wizyt u lekarzy. Lekarze mogą dodawać dostępne terminy, a pacjenci mogą je rezerwować. Administratorzy mają możliwość zarządzania użytkownikami oraz dodawania nowych lekarzy.

### Główne funkcjonalności:
- **Rejestracja i logowanie**: Użytkownicy mogą rejestrować się i logować do systemu w zależności od swojej roli (pacjent, lekarz, administrator).
- **Rezerwacja wizyt**: Pacjenci mogą przeglądać dostępne terminy i rezerwować wizyty.
- **Dodawanie terminów**: Lekarze mogą dodawać dostępne terminy wizyt.
- **Zarządzanie użytkownikami**: Administratorzy mogą zarządzać użytkownikami oraz dodawać nowych lekarzy.

### Sposób uruchomienia: 
- należy się upewnić że postgreSQL i php są zainstalowane.
- należy sie upewnić że w folderze php/ext znajdują się 2 pliki: php_pgsql.dll i php_pdo_pgsql.dll
- należy sie upewnić że odpowiednie linie są odkomentowane w pliku php/php.ini (jeśli nie ma pliku php.ini to należy zmienić nazwę pliku php.ini-development albo php.ini-production na php.ini):
- extension=pdo_pgsql&nbsp;&nbsp;&nbsp;&nbsp; extension=pgsql&nbsp;&nbsp;&nbsp;&nbsp; extension_dir = "ext" 
- ![obraz](https://github.com/user-attachments/assets/8c213104-9e69-47a2-9764-e35b330327d9) ![obraz](https://github.com/user-attachments/assets/4751d547-61d1-49de-bb1e-22cd82d2bcd1)
- w pliku php/Database.php zmienić wartość pól $user i $password na nazwę użytkownika i hasło do logowania do bazy postgreSQL <br />
![obraz](https://github.com/user-attachments/assets/3796014e-a24c-4dc6-a19d-07771fe3bc53)

- należy przenieść foldery php, public, sql do folderu, w którym będzie się chciało uruchomić program
- będąc w tym folderzy użyć komendy(za user użyć swojej nazwy użytkownika do bazy danych): psql -U user -f sql/database.sql
- uzyć komendy: php -S localhost:8000 -t public
- w przegląarce wpisać: http://localhost:8000/

### Logowanie do aplikacji:
Bazowo istnieją 3 konta: <br />
Pacjent: Jan Kowalski, jan@mail.com <br />
Lekarz: Kuba Nowak, kuba@mail.com <br />
Admin: admin admin, admin@mail.com <br />
Loguje się za pomocą maila i hasła, hasło admina: admin, pacjenta i lekarza: password <br />
Hasła są haszowane za pomocą bcrypt z kosztem 12.  <br />
