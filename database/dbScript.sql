-- Creating database
CREATE DATABASE rtassignment;
USE rtassignment;

-- Creating tables "patient" and "insurance"
CREATE TABLE patients (
    _id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pn VARCHAR(11) DEFAULT NULL,
    first VARCHAR(15) DEFAULT NULL,
    last VARCHAR(25) DEFAULT NULL,
    dob DATE DEFAULT NULL
);
CREATE TABLE insurance (
    _id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    patient_id INT(10) UNSIGNED NOT NULL,
    iname VARCHAR(40) DEFAULT NULL,
    from_date DATE DEFAULT NULL,
    to_date DATE DEFAULT NULL,
    FOREIGN KEY (patient_id) REFERENCES patient(id)
);

-- Sample data inserting
INSERT INTO patient (pn, first, last, dob)
VALUES ('12345678901', 'Toomas', 'Kull', '1990-01-01'),
    ('23456789012', 'Kadri', 'Kana', '1985-02-15'),
    ('34567890123', 'Andres', 'Kajakas', '1978-03-30'),
    ('45678901234', 'Kairi', 'Kurg', '1995-04-12'),
    ('56789012345', 'Jaan', 'Rähn', '1982-05-25'),
    ('67890123456', 'Mari', 'Kaur', '1991-06-07'),
    ('78901234567', 'Tõnis', 'Kotkas', '1976-07-20'),
    (
        '89012345678',
        'Kristiina',
        'Kullerkupp',
        '1988-08-02'
    ),
    ('90123456789', 'Kristjan', 'Kakk', '1997-09-15'),
    ('01234567890', 'Kärt', 'Pääsuke', '1980-10-28');

INSERT INTO insurance (patient_id, iname, from_date, to_date)
VALUES (
        1,
        'Estonian Health Insurance Fund',
        '2010-01-01',
        '2012-12-31'
    ),
    (1, 'AXA Insurance', '2013-01-01', '2015-12-31'),
    (
        2,
        'Swiss Life Insurance',
        '2012-06-01',
        '2014-05-31'
    ),
    (2, 'AIG Insurance', '2015-01-01', '2017-12-31'),
    (
        3,
        'Allianz Insurance',
        '2013-03-01',
        NULL
    ),
    (
        3,
        'Generali Insurance',
        '2016-01-01',
        '2018-12-31'
    ),
    (
        4,
        'MetLife Insurance',
        '2014-02-01',
        '2024-01-31'
    ),
    (
        4,
        'Hiscox Insurance',
        '2017-01-01',
        '2019-12-31'
    ),
    (5, 'Aetna Insurance', '2015-05-01', '2025-04-30'),
    (5, 'Cigna Insurance', '2018-01-01', '2020-12-31'),
    (
        6,
        'Munich Re Insurance',
        '2014-07-01',
        '2016-06-30'
    ),
    (
        6,
        'HDFC ERGO Insurance',
        '2017-01-01',
        '2019-12-31'
    ),
    (
        7,
        'Prudential Insurance',
        '2016-08-01',
        '2018-07-31'
    ),
    (7, 'Aviva Insurance', '2019-01-01', '2027-12-31'),
    (
        8,
        'Zurich Insurance',
        '2015-09-01',
        NULL
    ),
    (
        8,
        'State Farm Insurance',
        '2018-01-01',
        '2020-12-31'
    ),
    (9, 'Geico Insurance', '2016-10-01', '2018-09-30'),
    (
        9,
        'Nationwide Insurance',
        '2019-01-01',
        '2021-12-31'
    ),
    (
        10,
        'Travelers Insurance',
        '2017-11-01',
        NULL
    ),
    (
        10,
        'Progressive Insurance',
        '2020-01-01',
        '2022-12-31'
    );
    