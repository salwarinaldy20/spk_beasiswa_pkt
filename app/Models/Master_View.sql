create view vw_user as
SELECT
a.*, b.role as role_user, b.priviledges
from usr_user a
left join usr_role b on a.id_role = b.id;

--===========================================================

create view vw_rules as
SELECT
a.*,
b.nama_penyakit, b.penyebab, b.solusi,
c.gejala
FROM ms_rules a
left join ms_penyakit b on a.id_penyakit = b.id
left join ms_gejala c on a.id_gejala = c.id;

--===========================================================

create view vw_konsultasi_hasil as
SELECT
a.*,
b.nama_penyakit, b.penyebab, b.solusi
FROM tr_konsultasi_hasil a
left join ms_penyakit b on a.id_penyakit = b.id

--============================================================

create view vw_konsultasi_header as
SELECT
a.*,
b.nama as nama_pasien
FROM tr_konsultasi_header a
left join usr_user b on a.id_user = b.id

--============================================================



tr_konsultasi_header :
- id
- id_user
- catatan_pasien
- keterangan
- active
- created_on
- created_by
- updated_by
- updated_on

tr_konsultasi_detail :
- id
- id_header
- id_geala
- jawaban
- created_on
- created_by
- updated_by
- updated_on


tr_konsultasi_hasil :
- id
- id_header
- id_penyakit
- persentase

ms_rules :
- id
- id_penyakit
- id_gejala
- bobot
- created_by
- created_on


--===============================================================================

ms_kriteria
- id
- kode_kriteria
- kriteria
- created_on
- created_by
- updated_by
- updated_on

ms_atribut
- id
- atribut
- created_on
- created_by
- updated_by
- updated_on

ms_penilaian
- id
- nama_penilaian
- created_on
- created_by
- updated_by
- updated_on

ms_rules_penilaian
- id
- id_penilaian
- id_kriteria
- kepentingan_kriteria
- id_atribut
- nilai_atribut
- created_on
- created_by
- updated_by
- updated_on


ms_kategori_beasiswa
- id
- kode_kategori
- kategori
- created_on
- created_by
- updated_by
- updated_on

ms_periode
- id
- periode
- created_on
- created_by
- updated_by
- updated_on

tr_data_alternatif_header
- id
- id_periode
- id_penilaian
- kode_alternatif
- created_on
- created_by
- updated_by
- updated_on

tr_data_alternatif_detail
- id
- id_alternatif_header
- id_rules_penilaian
- nilai_rules
- created_on
- created_by
- updated_by
- updated_on

--=================================================================================

create view vw_rules_penilaian as
SELECT
a.*,
b.nama_penilaian,
c.kode_kriteria, c.kriteria,
d.atribut
FROM ms_rules_penilaian a
left join ms_penilaian b on a.id_penilaian = b.id
left join ms_kriteria c on a.id_kriteria = c.id
left join ms_atribut d on a.id_atribut = d.id
