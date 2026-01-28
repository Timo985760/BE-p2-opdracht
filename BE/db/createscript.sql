-- step : 01
-- ************************************************************
-- Doel Maak een nieuwe Database aan: Rollercoaster_2509A
-- ************************************************************
-- Versie   Datum       Auteur      Omschrijving
-- *******  ******      ******      ************
-- 01       05-12-2025  Timo    Database met de hoogste achtbanen van europa 
--
-- *************************************************************


-- verwijder de database Rollercoaster_2509A
DROP DATABASE IF EXISTS Rollercoaster_2509A;


-- Maak de database Rollercoaster_2509A
CREATE DATABASE Rollercoaster_2509A;


-- Gebruik de database
USE Rollercoaster_2509A;

-- step : 02
-- ************************************************************
-- Doel Maak een nieuwe tabel aan: Rollercoaster_2509A
-- ************************************************************
-- Versie   Datum       Auteur      Omschrijving
-- *******  ******      ******      ************
-- 01       05-12-2025  Timo    Tabel maken met de hoogste achtbanen van europa 
--
-- *************************************************************

-- Maak de tabel Rollercoaster

CREATE TABLE Rollercoaster
(
    Id                  SMALLINT     UNSIGNED        NOT NULL        AUTO_INCREMENT      Comment 'primary key of the rollercoaster table'
    ,Rollercoaster      VARCHAR(50)                  NOT NULL                            Comment 'Name of the RollerCoaster'
    ,AmusementPark      VARCHAR(50)                  NOT NULL                            Comment 'Name of the AmusementPark'
    ,Country            VARCHAR(50)                  NOT NULL                            Comment 'Country of origin'
    ,TopSpeed           SMALLINT    UNSIGNED         NOT NULL                            Comment 'TopSpeed in KM/H'
    ,Height             TINYINT     UNSIGNED         NOT NULL                            Comment 'Height in Meters'
    ,YearOfConstruction Date                         NOT NULL                            Comment 'Year of Construction'
    ,IsActive           BIT                          NOT NULL        DEFAULT 1           Comment 'indicates whether the rollercoaster is active(1)'
    ,Remark             VARCHAR(255)                 NULL            DEFAULT NULL        Comment 'optional remark or additional info'
    ,DateCreated        DATETIME(6)                  NOT NULL        DEFAULT NOW(6)      Comment 'timestamp when the record was created'
    ,DateChanged        DATETIME(6)                  NOT NULL        DEFAULT NOW(6)      Comment 'Timestamp of latest update'
    ,CONSTRAINT         PK_Rollercoaster_Id          PRIMARY KEY (Id)
) ENGINE=InnoDB;


-- step : 03
-- ************************************************************
-- Doel vul de tabel rollercoaster met data
-- ************************************************************
-- Versie   Datum       Auteur      Omschrijving
-- *******  ******      ******      ************
-- 01       05-12-2025  Timo    Vul tabel hoogste achtbanen van europa  
--
-- *************************************************************

-- Vul de tabel

INSERT INTO Rollercoaster
(
    Rollercoaster
    ,AmusementPark
    ,Country
    ,TopSpeed
    ,Height
    ,YearOfConstruction
)
VALUES
('Kingda Ka', 'Six Flags Great Adventure', 'Verenigd Koninkrijk', 206, 127, '2005-10-21'),
('Red Force', 'Ferrari Land', 'Spanje', 180, 112, '2017-04-07'),
('Hyperion', 'Energylandia', 'Polen', 142, 77, '2018-08-14'),
('Shambhala', 'PortAventura Park', 'Spanje', 134, 76, '2012-04-07'),
('Schwur des Kärnen', 'Hansa Park', 'Duitsland', 127, 73, '2017-02-25');