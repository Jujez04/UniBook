```mermaid
classDiagram
class DatabaseManager
%% class Admin (?)
class SessionManager

Book -- Catalogue
TagInBook --o Book
Tag -- TagInBook
BookCopy -- Book
Loan -- BookCopy
Review -- Loan
Student -- Booking
Booking -- Book
Student -- Loan
DatabaseManager o-- BookRepository
Book -- BookRepository
```