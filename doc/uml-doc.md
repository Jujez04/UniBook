```mermaid
classDiagram
class DatabaseHelper
%% class Admin (?)
class SessionManager
class SecurityManager

Book -- Catalogue
TagInBook --o Book
Tag -- TagInBook
BookCopy -- Book
Loan -- BookCopy
Review -- Loan
Student -- Booking
Booking -- Book
Student -- Loan

```