create database QLHS;
use QLHS;
create table MonHoc(
	MaMon varchar(10) primary key,
    tenMon varchar(30)
);

create table GiaoVien(
	MaGV varchar(10) primary key,
    MaMon varchar(10) not null,
    foreign key(MaMon) references MonHoc(MaMon),
    HoTen varchar(50),
    SDT varchar(20)
);

create table Lop(
	MaLop varchar(10),
    TenLop varchar(50),
    MaGVCN varchar(10) not null,
    foreign key(MaGVCN) REFERENCES GiaoVien(MaGV),
    TKB varchar(30),
    CONSTRAINT PK_Lop PRIMARY KEY (MaLop)
);



CREATE TABLE HocSinh (
  MaHS varchar(10) PRIMARY KEY,  
  MaLop VARCHAR(10) NOT NULL,
  FOREIGN KEY (MaLop) REFERENCES Lop(MaLop),
  HoTen VARCHAR(50),
  SDT VARCHAR(20),  
  QueQuan VARCHAR(30),
  GioiTinh VARCHAR(10),
  DiaChi VARCHAR(50),
  Email varchar(30)
);

Create table HocPhi(
	ThoIGian date primary key,
    ThongTinHocPhi varchar(30)
);

Create table TTHocPhi(
	MaHS varchar(10) not null,
    FOREIGN KEY (MaHS) REFERENCES HocSinh(MaHS),
    ThoiGian date not null,
    FOREIGN KEY (ThoiGian) REFERENCES HocPhi(ThoiGian),
    TinhTrang varchar(10),
    primary key(MaHS, ThoiGian) 
);

Create table Elearning(
	MaLop varchar(10) not null,
    foreign key (MaLop) References Lop(MaLop),
    MaMon varchar(10) not null,
    foreign key (MaMon) References MonHoc(MaMon),
    LinkBaiGiang varchar(100),
    LinkHocOnl varchar(100),
	primary key(MaLop, MaMon) 
);


create table studentAccount(
	MaHS varchar(10) not null, 
	FOREIGN KEY (MaHS) REFERENCES HocSinh(MaHS),
    TaiKhoan varchar(20) primary key,
    MatKhau varchar(32)
);

create table adminAccount(
    TaiKhoan varchar(20) primary key,
    MatKhau varchar(32)
);

create table resetPassword(
	MaHS varchar(10) not null,
	TaiKhoan varchar(10) not null,
	foreign key(TaiKhoan) references studentAccount(TaiKhoan),
    otp varchar(4),
    expired_on varchar(20),
    primary key(TaiKhoan)
);

create table KQHT(
	MaHS varchar(10) not null, 
	FOREIGN KEY (MaHS) REFERENCES HocSinh(MaHS),
	MaMon varchar(10) not null,
    foreign key(MaMon) references MonHoc(MaMon),
	QT1 double,
	GK double,
	CK double,
	primary key(MaHS, MaMon)
);



