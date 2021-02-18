import requests
f = open("../database/seeders/ErreurSeed.php","a",encoding="utf-8")
r=requests.get('http://127.0.0.1:8000/api/eror')
voitures=r.json()
f.write("<?php \n\n")
for v in voitures:
    v2='\App\Models\Listedefaut::create(["code"=>"'+v["code"]+'","categorie"=>"'+v["categorie"]+'","localisation"=>"'+str(v["localisation"])+'","description"=>"'+v["description"]+'"]);'
    f.write("\n"+v2)
    print(v2)

f.close()