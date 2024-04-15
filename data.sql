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

insert into adminAccount values ('admin', '21232f297a57a5a743894a0e4a801fc3'); /*pass: admin*/
insert into studentAccount values ('HS01','HS01_10A1','8466b50ac66df60d0313189094d3bfe2'); /*pass: giahuy02092004*/

