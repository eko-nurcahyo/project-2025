# PERHATIAN HARAP DI BACA DENGAN CERMAT DAN TELITI

## CONFIGURATION PROJECT

### CROSSCHECK REQUIREMENT
- Pastikan WSL Anda sudah **root**

```bash
whoami
```

- Install `jq`

```bash
apt install jq -y
```

- Hasil yang diharapkan:

```bash
❯ whoami
root
```

---

## SETUP AWAL

1. **Buka GitHub dan ambil setting Personal Access Token (PAT):**

   - URL: https://github.com/settings/tokens
   - Pilih menu **Personal Access Token (classic)** dan klik **Generate new token (classic)**
   - Isi Note dengan: `initscript`
   - Set **Expiration** ke **No expiration**
   - Centang semua akses pada **repo**, **user**, dan **delete_repo**

2. **Buat file di dalam folder `boilerplate`:**

```bash
touch .github-token
touch .github-user
```

3. **Masukkan token dan user ke file:**

- Di file `.github-token`, paste token GitHub yang telah dibuat
- Di file `.github-user`, ketikkan username GitHub Anda

---

## SETUP DI POWERSHELL (RUN AS ADMINISTRATOR)

1. Jalankan perintah berikut untuk mengubah Execution Policy:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
```

2. Install mkcert melalui Chocolatey:

```powershell
choco install mkcert
```

3. Install sertifikat lokal mkcert:

```powershell
mkcert -install
```

4. Restart laptop Anda

---

### Jika mengalami error saat install mkcert, coba langkah berikut di Powershell (Admin):

1. Hapus folder Chocolatey:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; `
[System.IO.Directory]::Delete("$env:ProgramData\chocolatey", $true)
```

2. Hapus Chocolatey dari PATH environment variable:

```powershell
$envPath = [Environment]::GetEnvironmentVariable("Path", [EnvironmentVariableTarget]::Machine)
$newPath = ($envPath -split ";") -ne "C:\ProgramData\chocolatey\bin" -join ";"
[Environment]::SetEnvironmentVariable("Path", $newPath, [EnvironmentVariableTarget]::Machine)
```

---

## MEMULAI PROJECT

Jalankan perintah berikut untuk setup project, misal nama project adalah `pemweb`:

```bash
./start.sh pemweb
```

---

## SETUP TERAKHIR DI TERMINAL WSL

Setelah semua selesai, lakukan reload konfigurasi shell dengan:

```bash
source /root/.zshrc
```

---

## PERINTAH TAMBAHAN YANG TERSEDIA

| Perintah | Deskripsi                                                             |
|----------|----------------------------------------------------------------------|
| `dcu`    | `docker-compose up -d` (menyalakan docker container)                 |
| `dcd`    | `docker-compose down` (mematikan docker container)                   |
| `dcm`    | Membuat model, controller, seeder, migration, filament resource      |
| `dci`    | Inisialisasi project (migrate, seed, fresh)                          |
| `dcr`    | Menghapus model, controller, seeder, migration, filament resource    |
| `dcp`    | Git add, commit, dan push sekaligus                                   |

### Contoh penggunaan:

```bash
dcu
dcd
dcm Test
dci
dcr Test
dcp "testing"
```

---

# CATATAN

Harap jalankan semua perintah Powershell dengan **Run as Administrator**.  
Pastikan semua konfigurasi sesuai agar project berjalan dengan lancar.
