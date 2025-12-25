#!/bin/bash

echo "🔧 Memperbaiki semua controller ID..."

# ========== 1. PERBAIKI CREATE ==========

# USER
grep -Rl "User::create" app/Http/Controllers \
| xargs sed -i '' 's/\$existing = User::pluck(\x27iduser\x27).*//g'

grep -Rl "User::create" app/Http/Controllers \
| xargs sed -i '' 's/\$nextId = User::max(\"iduser\") \+ 1;/\$nextId = User::max(\"iduser\") + 1;/g'


# ROLE
grep -Rl "Role::create" app/Http/Controllers \
| xargs sed -i '' 's/\$nextId = Role::max(\"idrole\") \+ 1;/\$nextId = Role::max(\"idrole\") + 1;/g'

# KATEGORI
grep -Rl "Kategori::create" app/Http/Controllers \
| xargs sed -i '' 's/\$nextId = Kategori::max(\"idkategori\") \+ 1;/\$nextId = Kategori::max(\"idkategori\") + 1;/g'

# PET
grep -Rl "Pet::create" app/Http/Controllers \
| xargs sed -i '' 's/\$nextId = Pet::max(\"idpet\") \+ 1;/\$nextId = Pet::max(\"idpet\") + 1;/g'

# PEMILIK
grep -Rl "Pemilik::create" app/Http/Controllers \
| xargs sed -i '' 's/\$nextId = Pemilik::max(\"idpemilik\") \+ 1;/\$nextId = Pemilik::max(\"idpemilik\") + 1;/g'

# JENIS HEWAN
grep -Rl "JenisHewan::create" app/Http/Controllers \
| xargs sed -i '' 's/\$nextId = JenisHewan::max(\"idjenis_hewan\") \+ 1;/\$nextId = JenisHewan::max(\"idjenis_hewan\") + 1;/g'

# RAS HEWAN
grep -Rl "RasHewan::create" app/Http/Controllers \
| xargs sed -i '' 's/\$nextId = RasHewan::max(\"idras_hewan\") \+ 1;/\$nextId = RasHewan::max(\"idras_hewan\") + 1;/g'



# ========== 2. PERBAIKI DELETE (SHIFT ID) ==========

# USER DELETE
grep -Rl "delete();" app/Http/Controllers/UserController.php \
| xargs sed -i '' 's/delete();/delete();\
        User::where("iduser", ">", $id)->decrement("iduser");/'

# KATEGORI DELETE
grep -Rl "delete();" app/Http/Controllers/KategoriController.php \
| xargs sed -i '' 's/delete();/delete();\
        Kategori::where("idkategori", ">", $id)->decrement("idkategori");/'

# PET DELETE
grep -Rl "delete();" app/Http/Controllers/PetController.php \
| xargs sed -i '' 's/delete();/delete();\
        Pet::where("idpet", ">", $id)->decrement("idpet");/'

# PEMILIK DELETE
grep -Rl "delete();" app/Http/Controllers/PemilikController.php \
| xargs sed -i '' 's/delete();/delete();\
        Pemilik::where("idpemilik", ">", $id)->decrement("idpemilik");/'

# RAS DELETE
grep -Rl "delete();" app/Http/Controllers/RasHewanController.php \
| xargs sed -i '' 's/delete();/delete();\
        RasHewan::where("idras_hewan", ">", $id)->decrement("idras_hewan");/'

# JENIS DELETE
grep -Rl "delete();" app/Http/Controllers/JenisHewanController.php \
| xargs sed -i '' 's/delete();/delete();\
        JenisHewan::where("idjenis_hewan", ">", $id)->decrement("idjenis_hewan");/'

echo "✅ SELESAI!"
