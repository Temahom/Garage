import requests
f = open("../database/seeders/ProduitSeed.php", "a",encoding="utf-8")
r=requests.get('http://127.0.0.1:8000/api/products')
voitures=r.json()
f.write("<?php \n\n")
for v in voitures:
    v2='\App\Models\Produit::create(["categorie"=>"'+v["categorie"]+'","produit"=>"'+v["produit"]+'","prix1"=>'+str(v["prix1"])+',"qte"=>'+str(v["qte"])+']);'
    f.write("\n"+v2)
    print(v2)

f.close()