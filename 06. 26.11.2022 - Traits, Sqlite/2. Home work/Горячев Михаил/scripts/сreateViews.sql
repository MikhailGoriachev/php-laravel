-- удаление представлений
drop view if exists ViewAppointments;
drop view if exists ViewDoctors;
drop view if exists ViewPatients;


-- представление таблицы Doctors			(ВРАЧИ)

-- удаление представления 
-- drop view if exists ViewDoctors;
-- 

-- создание представления
create view ViewDoctors
as
	select
		Doctors.Id
		, Persons.Surname					as DoctorSurname			-- Фамилия врача
		, Persons.[Name]					as DoctorName				-- Имя врача
		, Persons.Patronymic				as DoctorPatronymic			-- Отчество врача
		, Specialities.Speciality										-- Специальность
		, Doctors.Price													-- Цена приёма
		, Doctors.[Percent]												-- Процент от цены приёма врачу
	from
		Doctors inner join Persons on Doctors.IdPerson = Persons.Id
					inner join Specialities on Doctors.IdSpeciality = Specialities.Id;



-- представление таблицы Patients			(ПАЦИЕНТЫ)

-- удаление представления 
-- drop view if exists ViewPatients;
-- 

-- создание представления
create view ViewPatients
as
	select
		Patients.Id
		, Persons.Surname				as PatientSurname				-- Фамилия пациента
		, Persons.[Name]				as PatientName					-- Имя пациента
		, Persons.Patronymic			as PatientPatronymic			-- Отчество пациента
		, Patients.BornDate												-- Дата рождения пациента
		, Patients.[Address]											-- Адрес проживания пациента
		, Patients.Passport												-- Паспортные данные
	from
		Patients inner join Persons on Patients.IdPerson = Persons.Id;


-- представление таблицы Appointments		(ПРИЕМЫ)

-- удаление представления 
-- drop view if exists ViewAppointments;
-- 

-- создание представления
create view ViewAppointments
as
	select
		Appointments.Id
		, Appointments.AppointmentDate									-- Дата приёма
		, Doc.Surname						as DoctorSurname			-- Фамилия врача
		, Doc.[Name]						as DoctorName				-- Имя врача
		, Doc.Patronymic					as DoctorPatronymic			-- Отчество врача
		, Specialities.Speciality										-- Специальность
		, Doctors.Price													-- Цена приёма
		, Doctors.[Percent]												-- Процент от цены приёма врачу
		, Pat.Surname						as PatientSurname			-- Фамилия пациента
		, Pat.[Name]						as PatientName				-- Имя пациента
		, Pat.Patronymic					as PatientPatronymic		-- Отчество пациента
		, Patients.BornDate												-- Дата рождения пациента
		, Patients.[Address]											-- Адрес проживания пациента
		, Patients.Passport												-- Паспортные данные
	from
		Appointments inner join (Doctors inner join Persons Doc on Doctors.IdPerson = Doc.Id
						 						 inner join Specialities on Doctors.IdSpeciality = Specialities.Id) 
						 			on  Appointments.IdDoctor = Doctors.Id
						 inner join (Patients inner join Persons Pat on Patients.IdPerson = Pat.Id) 
									on  Appointments.IdPatient = Patients.Id
