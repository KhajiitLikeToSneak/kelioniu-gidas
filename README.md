# Kelionių gidas

## 1. Darbo užduotis 

Temos pavadinimas: Kelionių gidas. 

Pagrindinės funkcijos: 

* Kelionės maršruto išsirinkimo sistema pagal norimus lankomų objektų tipus.  
* Automatinis siūlymas nakvynės (renkantis maršrutą rodyti laiką kiek užtruks kiekvienas pasirinktas veiksmas (vykimas iki norimų objektų, aplankymas kiekvieno iš jų, numatyti artimiausias ir tinkamiausias nakvynės vietas pagal pageidavimą) 
* Pasiūlymai turi būti daromi pagal koreliacinę lentelę.

Papildomos funkcijos: 

* Detalus kelionės aprašymo generavimas. Vartotojų forumas, atsiliepimai. 
* Naujo objekto kūrimas. 
* Vartotojo užblokavimas/atblokavimas.

Sistemos vartotojų tipai:

* Keliautojas – gali atlikti visas išvardintas pagrindines funkcijas, taip pat generuoti kelionės aprašymą ir naudotis forumu. 
* Kūrėjas – gali sukurti naują objektą. 
* Administratorius – gali užlbokuoti ar atblokuoti vartotoją.

## 2. Panaudojimo atvejų diagrama

Keliautojo tipo vartotojas gali gauti kelionės maršrutą ir atsisiųsti PDF formatu, taip pat peržiūrėti forumą, kuriame pateikiami visi objektai, peržiūrėti jų atisliepimus ir palikti atsiliepimą apie konkretų objektą. Kūrėjas gali sukurti naują objektą. Administratorius gali užblokuoti arba atblokuoti tam tikrą vartotoją. 

![image](https://github.com/user-attachments/assets/c7620bca-8e02-46b0-bc26-1459958036b7)

## 3. Vartotojų darbo aplinkos

Prisijungti funkcija

![image](https://github.com/user-attachments/assets/f41cd7db-50b9-4270-b9f9-f48e65f6553b)

Registruotis funkcija 

![image](https://github.com/user-attachments/assets/6270dc34-f291-4110-b84a-a0ac4e41923c)

Gauti kelionės maršrutą funkcija ( forma užpildyta duomenimis ir atvaizduojami gauti rezultatai )

![image](https://github.com/user-attachments/assets/ab417ad9-fbce-43fe-ae74-c97fd3b13412)

![image](https://github.com/user-attachments/assets/2ba5e098-38a8-4a4d-a511-b8247d553440)

Atsisiųstas kelionės maršruto pdf

![image](https://github.com/user-attachments/assets/f7498200-1e0f-4145-9098-7acc4dc97c28)

![image](https://github.com/user-attachments/assets/efec4987-ba9d-45d9-9f1f-8b0727aee7e8)

![image](https://github.com/user-attachments/assets/c7176419-3c94-4e7f-9193-db243d247c9f)

Peržiūrėti forumą funkcija

![image](https://github.com/user-attachments/assets/0ab00286-3a92-4c8a-aa2c-b554098033af)

Peržiūrėti atsiliepimus / palikti atsiliepimą funkcija 

![image](https://github.com/user-attachments/assets/45fe8ba1-1359-4f6b-8574-4d8e81d888b8)

Sukurti naują objektą funkcija

![image](https://github.com/user-attachments/assets/984c06d0-b9f9-4303-831e-50866ebcc658)

Užblokuti/atblokuoti vartotoją funkcija 

![image](https://github.com/user-attachments/assets/06b83778-e037-416a-8f1c-5e1e15fe0e23)

## 4. Darbo išvados

Internetinė sistema pagal pateiktą užduotį suprojektuota sėkmingai
* Įvedamų duomenų kontrolė, realizuoti diagnostiniai pranešimai kai operacijų negalima įvykdyti dėl neteisingų ar nepilnų duomenų
* Paspaudus mygtuką atvaizduojamas operacijos rezultatas arba jos įvykdymo patvirtinimas
* Slaptažodžiai duomenų bazėje saugomi šifruoti
* Užtikrinta, kad nėra galimybės į sistemą patekti neprisijungus arba vykdyti kito vartotojo funkcijas
* Duomenų bazė užpildyta prasmingais duomenimis
* Sistema pilnai veikia lietuvių kalba
* Minimalus sistemos dizainas
