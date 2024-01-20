<?php
use App\Models\Region;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('indicatif');
            $table->string('code');
            $table->string('nom');
            $table->string('position')->nullable();
            $table->timestamps();
        });

        $regions=[
            
            //https://www.alao.ch/fr/blogs/indicatifs-telephoniques-internationaux/

        //Zone 1 : Amérique du Nord et Caraïbes

           ["+1XXX","🇺🇸","États-Unis et ses territoires"], 
           ["+1XXX","🇨🇦","Canada"],
           ["+1242","🇧🇸","Bahamas"],
           ["+1246","🇧🇧","Barbade"],
           ["+1264","🇦🇮","Anguilla"],
           ["+1268","🇦🇬","Antigua et Barbuda"],
           ["+1284","🇻🇬","Îles Vierges britanniques"],
           ["+1340","🇻🇮","Îles Vierges américaines"],
           ["+1345","🇰🇾","Îles Caïmans"],
           ["+1441","🇧🇲","Bermudes"],
           ["+1473","🇬🇩","Grenade"],
           ["+1649","🇹🇨","Îles Turks et Caicos"],
           ["+1664","🇲🇸","Montserrat"],
           ["+1670","🇲🇵","Îles Mariannes du Nord"],
           ["+1671","🇬🇺","Guam"],
           ["+1684","🇦🇸","Samoa américaines"],
           ["+1721","🇸🇽","Saint-Martin"],
           ["+1758","🇱🇨","Sainte-Lucie"],
           ["+1767","🇩🇲","Dominique"],
           ["+1784","🇻🇨","Saint-Vincent-et-les-Grenadines"],
           ["+1787","🇵🇷","Porto Rico"],
           ["+1808","🇺🇸","Hawaï"],
           ["+1809","🇩🇴","République dominicaine"],
           ["+1829","🇩🇴","République dominicaine"],
           ["+1849","🇩🇴","République dominicaine"],
           ["+1868","🇹🇹","Trinité-et-Tobago"],
           ["+1869","🇰🇳","Saint-Kitts-et-Nevis"],
           ["+1876","🇯🇲","Jamaïque"],
           ["+1939","🇵🇷","Porto Rico"],

        //Zone 2 : Afrique et Groenland
            ["+20","🇪🇬", "Égypte"],
            ["+211","🇸🇸", "Sud Soudan"],
            ["+212","🇲🇦", "Maroc"],
            ["+213","🇩🇿", "Algérie"],
            ["+216","🇹🇳", "Tunisie"],
            ["+218","🇱🇾", "Libye"],
            ["+220","🇬🇲", "Gambie"],
            ["+221","🇸🇳", "Sénégal"],
            ["+222","🇲🇷", "Mauritanie"],
            ["+223","🇲🇱", "Mali"],
            ["+224","🇬🇳", "Guinée"],
            ["+225","🇨🇮", "Côte d'Ivoire"],
            ["+226","🇧🇫", "Burkina Faso"],
            ["+227","🇳🇪", "Niger"],
            ["+228","🇹🇬", "Togo"],
            ["+229","🇧🇯","Bénin"],

            ["+230","🇲🇺", "Maurice"],
            ["+231","🇱🇷","Liberia"],
            ["+232","🇸🇱", "Sierra Leone"],
            ["+233","🇬🇭", "Ghana"],
            ["+234","🇳🇬", "Nigeria"],
            ["+235","🇹🇩", "Tchad"],
            ["+236","🇨🇫", "République centrafricaine"],
            ["+237","🇨🇲", "Cameroun"],
            ["+238","","Cap-Vert"],
            ["+239","🇸🇹", "Sao Tomé et Principe"],

            ["+240","🇬🇶", "Guinée équatoriale"],
            ["+241","🇬🇦", "Gabon"],
            ["+242","🇨🇬", "République du Congo"],
            ["+243","🇨🇩", "République démocratique du Congo"],
            ["+244","🇦🇴","Angola"],
            ["+245","🇬🇼","Guinée-Bissau"],
            ["+246","🇮🇴","Territoire britannique de l'océan Indien"] ,
            ["+247","🇦🇨","Ascension"],
            ["+248","🇸🇨","Seychelles"],
            ["+249","🇸🇩","Soudan"],

            ["+250","🇷🇼","Rwanda"],
            ["+251","🇪🇹","Éthiopie"],
            ["+252","🇸🇴","Somalie"],
            ["+253","🇩🇯","Djibouti"],
            ["+254","🇰🇪","Kenya"],
            ["+255","🇹🇿","Tanzanie"],
            ["+256","🇺🇬","Ouganda"],
            ["+257","🇧🇮","Burundi"],
            ["+258","🇲🇿","Mozambique"],

            ["+260","🇿🇲","Zambie"],
            ["+261","🇲🇬","Madagascar"],
            ["+262","🇷🇪 Réunion, 🇾🇹 Mayotte","Territoires français océan Indien, y compris" ],
            ["+263","🇿🇼","Zimbabwe"],
            ["+264","🇳🇦","Namibie"],
            ["+265","🇲🇼","Malawi"],
            ["+266","🇱🇸","Lesotho"],
            ["+267","🇧🇼","Botswana"],
            ["+268","🇸🇿","Eswatini"],
            ["+269","🇰🇲","Comores"],

            ["+27","🇿🇦","Afrique du Sud"],

            ["+290","🇸🇭","Sainte-Hélène"],
            ["+290 8","🇹🇦","Tristan da Cunha"],
            ["+291","🇪🇷","Érythrée"],
            ["+297","🇦🇼","Aruba"],
            ["+298","🇫🇴","Îles Féroé"],
            ["+299","🇬🇱","Groenland"],

        //Zone 3 : Europe   
            ["+30","🇬🇷"," Grèce"],
            ["+31","🇳🇱"," Pays-Bas"],
            ["+32","🇧🇪"," Belgique"],
            ["+33","🇫🇷"," France"],
            ["+34","🇪🇸"," Espagne"],

            ["+350","🇬🇮"," Gibraltar"],
            ["+351","🇵🇹"," Portugal"],
            ["+352","🇱🇺"," Luxembourg"],
            ["+353","🇮🇪"," Irlande"],
            ["+354","🇮🇸"," Islande"],
            ["+355","🇦🇱"," Albanie"],
            ["+356","🇲🇹"," Malte"],
            ["+357","🇨🇾"," Chypre"],
            ["+358","🇫🇮 ","Finlande"],
            ["+359","🇧🇬"," Bulgarie"],
            ["+36","🇭🇺"," Hongrie"],

            ["+370","🇱🇹"," Lituanie"],
            ["+371","🇱🇻 ","Lettonie"],
            ["+372","🇪🇪 ","Estonie"],
            ["+373","🇲🇩"," Moldavie"],
            ["+374","🇦🇲 ","Arménie, y compris Arzakh (Nagorno-Karabakh)"],
            ["+375","🇧🇾 ","Bélarus"],
            ["+376","🇦🇩 ","Andorre"],
            ["+377","🇲🇨"," Monaco"],
            ["+378","🇸🇲"," Saint-Marin"],
            ["+379","🇻🇦 ","Cité du Vatican (actuellement non utilisé ; joignable via 3906 (Italie))"],

            ["+380","🇺🇦"," Ukraine (Crimée seulement partiellement)[3]"],
            ["+381","🇷🇸"," Serbie"],
            ["+382","🇲🇪 ","Monténégro"],
            ["+383","🇽🇰 ","Kosovo"],
            ["+385","🇭🇷"," Croatie"],
            ["+386","🇸🇮"," Slovénie"],
            ["+387","🇧🇦"," Bosnie et Herzégovine"],
            ["+389","🇲🇰"," Macédoine du Nord"],
            ["+39","🇮🇹"," Italie"],

        //Zone 4 : Europe du Nord et de l'Est
            ["+40","🇷🇴","Roumanie"],
            ["+41","🇨🇭"," Suisse"],
            ["+420","🇨🇿"," République tchèque"],
            ["+421","🇸🇰"," Slovaquie"],
            ["+423","🇱🇮"," Liechtenstein"],
            ["+43","🇦🇹"," Autriche"],
            ["+44","🇬🇧"," Royaume-Uni"],
            ["+45","🇩🇰"," Danemark, sans les îles Féroé (+298), sans le Groenland (+299)"],
            ["+46","🇸🇪"," Suède"],
            ["+47","🇳🇴"," Norvège"],
            ["+48","🇵🇱"," Pologne"],
            ["+49","🇩🇪"," Allemagne"],

        //Zone 5 : Amérique centrale et du Sud
            ["+500","🇫🇰"," Îles Falkland"],
            ["+501","🇧🇿 ","Belize"],
            ["+502","🇬🇹 ","Guatemala"],
            ["+503","🇸🇻 ","El Salvador"],
            ["+504","🇭🇳"," Honduras"],
            ["+505","🇳🇮 ","Nicaragua"],
            ["+506","🇨🇷 ","Costa Rica"],
            ["+507","🇵🇦"," Panama"],
            ["+508","🇵🇲 ","Saint-Pierre et Miquelon"],
            ["+509","🇭🇹 ","Haïti"],

            ["+51","🇵🇪"," Pérou"],
            ["+52","🇲🇽"," Mexique"],
            ["+53","🇨🇺"," Cuba"],
            ["+54","🇦🇷"," Argentine"],
            ["+55","🇧🇷"," Brésil"],
            ["+56","🇨🇱"," Chili"],
            ["+57","🇨🇴"," Colombie"],
            ["+58","🇻🇪"," Venezuela"],

            ["+590","🇬🇵"," Guadeloupe, 🇲🇫 St. Martin, 🇧🇱 Saint-Barthélemy"],
            ["+591","🇧🇴"," Bolivie"],
            ["+592","🇬🇾"," Guyane"],
            ["+593","🇪🇨"," Équateur"],
            ["+594","🇬🇫"," Guyane française"],
            ["+595","🇵🇾"," Paraguay"],
            ["+596","🇲🇶"," Martinique"],
            ["+597","🇸🇷"," Suriname"],
            ["+598","🇺🇾"," Uruguay"],
            ["+599","🇧🇶"," Bonaire, 🇨🇼 Curaçao, 🇧🇶 Saba et 🇧🇶 Sint Eustatius"],
        
        //Zone 6 : Asie du Sud-Est, Australie et Océanie

            ["+60","🇲🇾"," Malaisie"],
            ["+61","🇦🇺"," Australie (y compris 🇨🇨 Îles Cocos et 🇨🇽 Île Christmas)"],
            ["+62","🇮🇩 ","Indonésie"],
            ["+63","🇵🇭"," Philippines"],
            ["+64","🇳🇿"," Nouvelle-Zélande"],
            ["+65","🇸🇬 ","Singapour"],
            ["+66","🇹🇭 ","Thaïlande"],

            ["+670","🇹🇱"," Timor oriental"],
            ["+672","🇦🇶 ","Antarctique, 🇳🇫 Île Norfolk"],
            ["+673","🇧🇳"," Brunei"],
            ["+674","🇳🇷 ","Nauru"],
            ["+675","🇵🇬"," Papouasie-Nouvelle-Guinée"],
            ["+676","🇹🇴"," Tonga"],
            ["+677","🇸🇧 ","Îles Salomon"],
            ["+678","🇻🇺"," Vanuatu"],
            ["+679","🇫🇯 ","Fidji"],

            ["+680","🇵🇼 ","Palau (Belau)"],
            ["+681","🇼🇫"," Wallis et Futuna"],
            ["+682","🇨🇰 ","Îles Cook"],
            ["+683","🇳🇺"," Niue"],
            ["+685","🇼🇸"," Samoa"],
            ["+686","🇰🇮"," Kiribati, Îles Gilbert"],
            ["+687","🇳🇨 ","Nouvelle-Calédonie"],
            ["+688","🇹🇻 ","Tuvalu, Îles Elliques"],
            ["+689","🇵🇫 ","Polynésie française"],

            ["+690","🇹🇰 ","Tokelau"],
            ["+691","🇫🇲"," États fédérés de Micronésie"],
            ["+692","🇲🇭"," Îles Marshall"],

        //Zone 7 : Russie, territoires occupés par la Russie et Kazakhstan

           [ "+7","🇷🇺"," Russie"],

        //Zone 8 : Asie du Sud-Est et de l'Est et numéros spéciaux

            ["+81","🇯🇵"," Japon"],
            ["+82","🇰🇷 ","Corée du Sud (République de Corée)"],
            ["+84","🇻🇳"," Vietnam"],

            ["+850","🇰🇵"," Corée du Nord (République populaire démocratique de Corée)"],
            ["+852","🇭🇰"," Hong Kong"],
            ["+853","🇲🇴"," Macao"],
            ["+855","🇰🇭"," Cambodge"],
            ["+856","🇱🇦"," Laos"],

            ["+86","🇨🇳"," République populaire de Chine"],

            ["+880","🇧🇩"," Bangladesh"],

            ["+886","🇹🇼"," Taïwan"],

        //Zone 9 : Moyen-Orient, Asie occidentale, centrale et du Sud

            ["+90","🇹🇷 ","Turquie, République turque de Chypre du Nord"],
            ["+91","🇮🇳 ","Inde"],
            ["+92","🇵🇰 ","Pakistan"],
            ["+93","🇦🇫"," Afghanistan"],
            ["+94","🇱🇰"," Sri "],
            ["+95","🇲🇲"," Myanmar"],

            ["+960","🇲🇻 ","Maldives"],
            ["+961","🇱🇧"," Liban"],
            ["+962","🇯🇴 ","Jordanie"],
            ["+963","🇸🇾 ","Syrie"],
            ["+964","🇮🇶 ","Irak"],
            ["+965","🇰🇼"," Koweït"],
            ["+966","🇸🇦 ","Arabie Saoudite"],
            ["+967","🇾🇪 ","Yémen"],
            ["+968","🇴🇲 ","Oman"],

            ["+970","🇵🇸 ","Palestine"],
            ["+971","🇦🇪"," Émirats arabes unis"],
            ["+972","🇮🇱"," Israël"],
            ["+973","🇧🇭"," Bahreïn"],
            ["+974","🇶🇦"," Qatar"],
            ["+975","🇧🇹"," Bhoutan"],
            ["+976","🇲🇳"," Mongolie"],
            ["+977","🇳🇵"," Népal"],

            ["+98","🇮🇷"," Iran"],

            ["+992","🇹🇯"," Tadjikistan"],
            ["+993","🇹🇲"," Turkménistan"],
            ["+994","🇦🇿 ","Azerbaïdjan"],
            ["+995","🇬🇪"," Géorgie (sans les territoires occupés par la Russie)"],
            ["+996","🇰🇬"," Kirghizistan"],
            ["+997","🇰🇿 ","Kazakhstan"],
            ["+998","🇺🇿 ","Ouzbékistan"],


        ];

        foreach($regions as $region){
            Region::create([
                'indicatif'=>$region[0],
                'code'=>$region[1],
                'nom'=>$region[2],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
