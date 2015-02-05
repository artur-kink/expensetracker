create schema expensetracker;

use expensetracker;

create table expense_types(
	Id int NOT NULL auto_increment primary key,
    `Name` varchar(64) unique
);

insert into expense_types(`Name`) values('Food');
insert into expense_types(`Name`) values('Transit');
insert into expense_types(`Name`) values('Other');


create table expenses(
	Id int NOT NULL auto_increment PRIMARY KEY,
    ExpenseTime datetime NOT NULL,
    Amount decimal(8,2) NOT NULL,
    `Name` varchar(255),
    `Type` int not null,
    CONSTRAINT FOREIGN KEY (`Type`) REFERENCES `expense_types` (`Id`) 
);

DELIMITER $$
CREATE PROCEDURE `InsertExpense` (IN inExpenseTime datetime,
IN inAmount decimal(8,2), IN inName varchar(255), IN inType int)
BEGIN
	insert into expenses(ExpenseTIme, Amount, `Name`, `Type`)
    values(inExpenseTime, inAmount, inName, inType);
END$$
DELIMITER ;
