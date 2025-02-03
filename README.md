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

## Strona główna <br />
![obraz](https://github.com/user-attachments/assets/a7e16594-cc95-4969-b12c-d6574d7cd188)
## Strona logowania <br />
![obraz](https://github.com/user-attachments/assets/7846115d-8a6d-424b-ab22-0f4d3f3e06db)
## Strona rejestracji <br />
![obraz](https://github.com/user-attachments/assets/581541fd-f307-4b4f-9f71-22569bc0583e)
## Strona pacjenta <br />
![obraz](https://github.com/user-attachments/assets/e18289d0-059b-4eb2-b972-5a1d9a622be4)
## Strona lekarza <br />
![obraz](https://github.com/user-attachments/assets/7ea214d1-0fc9-482f-a570-891e9cf2546c)
## Strona admina <br />
![obraz](https://github.com/user-attachments/assets/b0ba0ad7-671b-4812-af06-a6a0040e5f18)
## Strona dodawania terminu <br />
![obraz](https://github.com/user-attachments/assets/4564278d-9109-4550-9999-6cd293eb954e)
## Strona dodawania lekarza <br />
![obraz](https://github.com/user-attachments/assets/05c4aa74-0f4d-422d-a9ed-e682551045b3)

### Struktura bazy danych:
![obraz](https://github.com/user-attachments/assets/6a614f8a-b9ba-4e05-9c63-e15c1421a92c)
