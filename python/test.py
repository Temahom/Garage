import requests
f = open("../database/seeders/VoitureSeed.php", "a")
r=requests.get('http://127.0.0.1:8000/api/voitures')
voitures=r.json()
f.write("<?php \n\n")
for v in voitures:
    v2='\App\Models\Liste::create(["marques"=>"'+v["marques"]+'","lemodel"=>"'+v["lemodel"]+'","lannee"=>"'+v["lannee"]+'","lecarburant"=>"'+v["lecarburant"]+'","lapuissance"=>'+v["lapuissance"]+']);'
    f.write("\n"+v2)
    print(v2)

f.close()
#print(voiture[0]['id'])