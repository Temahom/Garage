import requests
f = open("../database/seeders/ProduitSeed.php", "a")
r=requests.get('http://127.0.0.1:8000/api/listesp')
voitures=r.json()
f.write("<?php \n\n")
for v in voitures:
    v2='\App\Models\listeproduit::create(["categorie"=>"'+v["categorie"]+'","produit"=>"'+v["produit"]+'","prix1"=>'+str(v["prix1"])+']);'
    f.write("\n"+v2)
    print(v2)

f.close()