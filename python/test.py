import requests
f = open("VoitureSeed.txt", "a")
r=requests.get('http://127.0.0.1:8000/api/listes')
voitures=r.json()
for v in voitures:
    v2='\App\Models\Liste::create(["marques"=>"'+v["marques"]+'","lemodel"=>"'+v["lemodel"]+'","lannee"=>"'+v["lemodel"]+'","lecarburant"=>"'+v["lecarburant"]+'","lapuissance"=>'+v["lapuissance"]+']);'
    f.write("\n"+v2)
    print(v2)

f.close()
#print(voiture[0]['id'])