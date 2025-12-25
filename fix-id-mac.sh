

#!/bin/bash

echo "🔧 Memperbaiki semua controller ID..."

# ===== 1. PERBAIKI CREATE =====

grep -Rl "User::create" app/Http/Controllers \
| xargs sed -i '' 's/User::create(/$nextId = User::max("iduser") + 1;\n        User::create(/'

grep -Rl "Role::create" app/Http/Controllers \
| xargs sed -i '' 's/Role::create(/$nextId = Role::max("idrole") + 1;\n        Role::create(/'

grep -Rl "Kategori::create" app/Http/Controllers \
| xargs sed -i '' 's/Kategori::create(/$nextId = Kategori::max("idkategori") + 1;\n        Kategori::create(/'

grep -Rl "Pet::create" app/Http/Controllers \
| xargs sed -i '' 's/Pet::create(/$nextId = Pet::max("idpet") + 1;\n        Pet::create(/'

grep -Rl "Pemilik::create" app/Http/Controllers \
| xargs sed -i '' 's/Pemilik::create(/$nextId = Pemilik::max("idpemilik") + 1;\n        Pemilik::create(/'

grep -Rl "JenisHewan::create" app/Http/Controllers \
| xargs sed -i '' 's/JenisHewan::create(/$nextId = JenisHewan::max("idjenis_hewan") + 1;\n        JenisHewan::create(/'

grep -Rl "RasHewan::create" app/Http/Controllers \
| xargs sed -i '' 's/RasHewan::create(/$nextId = RasHewan::max("idras_hewan") + 1;\n        RasHewan::create(/'

# ===== 2. PERBAIKI DELETE =====

gr
'/Users/ochadellafitriani/Desktop/myapp/nano fix-id-mac.sh'

