SET SQL_SAFE_UPDATES = 0;

insert into MonHoc values ('T', 'Toan');
insert into MonHoc values ('V', 'Van');
insert into MonHoc values ('L', 'Ly');
insert into MonHoc values ('H', 'Hoa');
insert into MonHoc values ('SH', 'Sinh Hoc');
insert into MonHoc values ('S', 'Su');
insert into MonHoc values ('D', 'Dia');
insert into MonHoc values ('TH', 'Tin Hoc');

insert into GiaoVien values ('GV01','L', 'Nguyen Thi Bich L','01123112411');
insert into GiaoVien values ('GV02','T', 'Tran Van V','21312542354');
insert into GiaoVien values ('GV03','H', 'Nguyen Thi T','12312123534');
insert into GiaoVien values ('GV04','V', 'Nguyen Thi Tuyet N','61345235364');
insert into GiaoVien values ('GV05','SH', 'Nguyen Van T','342623646');
insert into GiaoVien values ('GV06','S', 'Nguyen Dang K','34262346364');
insert into GiaoVien values ('GV07','D', 'Nguyen Tran Ngoc D','34623463212');
insert into GiaoVien values ('GV08','TH', 'Hua Minh T','23421342143');

insert into Lop values ('10A1', 'Muoi A 1','GV01','10A1.xlsx');
insert into Lop values ('10A2', 'Muoi A 2','GV04','10A2.xlsx');
insert into Lop values ('10A3', 'Muoi A 3','GV07','10A3.xlsx');

insert into HocSinh values('HS01', '10A1', 'Nguyen Trong H', '+84 783 865 7915', 'TPHCM', 'Nam', 'TPHCM', 'giahuyasdfghjk@gmail.com');
insert into HocSinh values('HS02', '10A1', 'Nguyen Thi Xuan H', '+84 795 639 2484', 'TPHCM', 'Nu', 'TPHCM', 'HS02@gmail.com');
insert into HocSinh values('HS03', '10A1', 'Nguyen Hoang D', '+84 723 919 2854', 'Ha Noi', 'Nam', 'TPHCM', 'HS03@gmail.com');
insert into HocSinh values('HS04', '10A2', 'Nguyen Minh T', '+84 791 372 0289', 'Kien Giang', 'Nam', 'TPHCM', 'HS04@gmail.com');
insert into HocSinh values('HS05', '10A2', 'Nguyen Hoang Yen V', '+84 530 510 1724', 'TPHCM', 'Nu', 'TPHCM', 'HS05@gmail.com');
insert into HocSinh values('HS06', '10A2', 'Nguyen Phuoc L', '+84 569 713 9599', 'TPHCM', 'Nam', 'TPHCM', 'HS06@gmail.com');
insert into HocSinh values('HS07', '10A3', 'Le Thi Bao A', '+84 238 822 3099', 'TPHCM', 'Nu', 'TPHCM', 'HS07@gmail.com');
insert into HocSinh values('HS08', '10A3', 'Nguyen Thi Kim T', '+84 238 822 3099', 'TPHCM', 'Nu', 'TPHCM', 'HS08@gmail.com');
insert into HocSinh values('HS09', '10A3', 'Le Truong Minh N', '+84 982 887 0446', 'TPHCM', 'Nam', 'TPHCM', 'HS09@gmail.com');

insert into Elearning values('10A1', 'D', '', '');
insert into Elearning values('10A1', 'H', '', '');
insert into Elearning values('10A1', 'L', '', '');
insert into Elearning values('10A1', 'S', '', '');
insert into Elearning values('10A1', 'SH', '', '');
insert into Elearning values('10A1', 'T', '', '');
insert into Elearning values('10A1', 'TH', '', '');
insert into Elearning values('10A1', 'V', '', '');

insert into Elearning values('10A2', 'D', '', '');
insert into Elearning values('10A2', 'H', '', '');
insert into Elearning values('10A2', 'L', '', '');
insert into Elearning values('10A2', 'S', '', '');
insert into Elearning values('10A2', 'SH', '', '');
insert into Elearning values('10A2', 'T', '', '');
insert into Elearning values('10A2', 'TH', '', '');
insert into Elearning values('10A2', 'V', '', '');

insert into Elearning values('10A3', 'D', '', '');
insert into Elearning values('10A3', 'H', '', '');
insert into Elearning values('10A3', 'L', '', '');
insert into Elearning values('10A3', 'S', '', '');
insert into Elearning values('10A3', 'SH', '', '');
insert into Elearning values('10A3', 'T', '', '');
insert into Elearning values('10A3', 'TH', '', '');
insert into Elearning values('10A3', 'V', '', '');

insert into kqht values('HS01', 'D', '', '', '');
insert into kqht values('HS01', 'H', '', '', '');
insert into kqht values('HS01', 'L', '', '', '');
insert into kqht values('HS01', 'S', '', '', '');
insert into kqht values('HS01', 'SH', '', '', '');
insert into kqht values('HS01', 'T', '', '', '');
insert into kqht values('HS01', 'TH', '', '', '');
insert into kqht values('HS01', 'V', '', '', '');

insert into kqht values('HS02', 'D', '', '', '');
insert into kqht values('HS02', 'H', '', '', '');
insert into kqht values('HS02', 'L', '', '', '');
insert into kqht values('HS02', 'S', '', '', '');
insert into kqht values('HS02', 'SH', '', '', '');
insert into kqht values('HS02', 'T', '', '', '');
insert into kqht values('HS02', 'TH', '', '', '');
insert into kqht values('HS02', 'V', '', '', '');

insert into kqht values('HS03', 'D', '', '', '');
insert into kqht values('HS03', 'H', '', '', '');
insert into kqht values('HS03', 'L', '', '', '');
insert into kqht values('HS03', 'S', '', '', '');
insert into kqht values('HS03', 'SH', '', '', '');
insert into kqht values('HS03', 'T', '', '', '');
insert into kqht values('HS03', 'TH', '', '', '');
insert into kqht values('HS03', 'V', '', '', '');

insert into kqht values('HS04', 'D', '', '', '');
insert into kqht values('HS04', 'H', '', '', '');
insert into kqht values('HS04', 'L', '', '', '');
insert into kqht values('HS04', 'S', '', '', '');
insert into kqht values('HS04', 'SH', '', '', '');
insert into kqht values('HS04', 'T', '', '', '');
insert into kqht values('HS04', 'TH', '', '', '');
insert into kqht values('HS04', 'V', '', '', '');

insert into kqht values('HS05', 'D', '', '', '');
insert into kqht values('HS05', 'H', '', '', '');
insert into kqht values('HS05', 'L', '', '', '');
insert into kqht values('HS05', 'S', '', '', '');
insert into kqht values('HS05', 'SH', '', '', '');
insert into kqht values('HS05', 'T', '', '', '');
insert into kqht values('HS05', 'TH', '', '', '');
insert into kqht values('HS05', 'V', '', '', '');

insert into kqht values('HS06', 'D', '', '', '');
insert into kqht values('HS06', 'H', '', '', '');
insert into kqht values('HS06', 'L', '', '', '');
insert into kqht values('HS06', 'S', '', '', '');
insert into kqht values('HS06', 'SH', '', '', '');
insert into kqht values('HS06', 'T', '', '', '');
insert into kqht values('HS06', 'TH', '', '', '');
insert into kqht values('HS06', 'V', '', '', '');

insert into kqht values('HS07', 'D', '', '', '');
insert into kqht values('HS07', 'H', '', '', '');
insert into kqht values('HS07', 'L', '', '', '');
insert into kqht values('HS07', 'S', '', '', '');
insert into kqht values('HS07', 'SH', '', '', '');
insert into kqht values('HS07', 'T', '', '', '');
insert into kqht values('HS07', 'TH', '', '', '');
insert into kqht values('HS07', 'V', '', '', '');

insert into kqht values('HS08', 'D', '', '', '');
insert into kqht values('HS08', 'H', '', '', '');
insert into kqht values('HS08', 'L', '', '', '');
insert into kqht values('HS08', 'S', '', '', '');
insert into kqht values('HS08', 'SH', '', '', '');
insert into kqht values('HS08', 'T', '', '', '');
insert into kqht values('HS08', 'TH', '', '', '');
insert into kqht values('HS08', 'V', '', '', '');

insert into adminAccount values ('admin', '21232f297a57a5a743894a0e4a801fc3'); /*pass: admin*/
insert into studentAccount values ('HS01','HS01_10A1','8466b50ac66df60d0313189094d3bfe2'); /*pass: giahuy02092004*/

