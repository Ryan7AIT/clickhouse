<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});









Route::get("getusers", function() {

    /** @var \ClickHouseDB\Client $db */
        $db = DB::connection('clickhouse')->getClient();

        $query = 'SELECT
                    s.zone AS zone_designation,
                    s.zone_id AS zone,
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1561 THEN prix_total_ht ELSE 0 END)) AS "Pallet_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1111 THEN prix_total_ht ELSE 0 END)) AS "Vita C+ 33 cl_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1261 THEN prix_total_ht ELSE 0 END)) AS "Power Fruits 33 Cl_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1361 THEN prix_total_ht ELSE 0 END)) AS "Jetable Jus 25 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1371 THEN prix_total_ht ELSE 0 END)) AS "Jetable Lacté 25 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 39 THEN prix_total_ht ELSE 0 END)) AS "Donuts 27 Pcs_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1421 THEN prix_total_ht ELSE 0 END)) AS "Jiji 20 GR_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1431 THEN prix_total_ht ELSE 0 END)) AS "Jiji 30 GR_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1501 THEN prix_total_ht ELSE 0 END)) AS "(B) Smarty_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1551 THEN prix_total_ht ELSE 0 END)) AS "Milky Kids 125 ML_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 40 THEN prix_total_ht ELSE 0 END)) AS "Donuts 09 Pcs_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1 THEN prix_total_ht ELSE 0 END)) AS "04_Extra 30 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 2 THEN prix_total_ht ELSE 0 END)) AS "05_Ramy 1,25 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 3 THEN prix_total_ht ELSE 0 END)) AS "05_Extra 1,25 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 4 THEN prix_total_ht ELSE 0 END)) AS "06_Ramy 2 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 5 THEN prix_total_ht ELSE 0 END)) AS "06_Extra 2 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1141 THEN prix_total_ht ELSE 0 END)) AS "Frutty 1,25 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 7 THEN prix_total_ht ELSE 0 END)) AS "08_Frutty 2 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 8 THEN prix_total_ht ELSE 0 END)) AS "02_Maltée 33 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 9 THEN prix_total_ht ELSE 0 END)) AS "03_Energétique 33 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 10 THEN prix_total_ht ELSE 0 END)) AS "01_Jus 24 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 11 THEN prix_total_ht ELSE 0 END)) AS "(C) Gazeifie 33 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 12 THEN prix_total_ht ELSE 0 END)) AS "(C) Maltée 33 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 45 THEN prix_total_ht ELSE 0 END)) AS "Water Fruits 33 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 42 THEN prix_total_ht ELSE 0 END)) AS "Gazéifié 33 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 6 THEN prix_total_ht ELSE 0 END)) AS "16_Kids 125 ML_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 47 THEN prix_total_ht ELSE 0 END)) AS "Water Fruits 1 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 13 THEN prix_total_ht ELSE 0 END)) AS "(P) Ramy 20 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 14 THEN prix_total_ht ELSE 0 END)) AS "(P) Ramy 1 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 41 THEN prix_total_ht ELSE 0 END)) AS "(P) Ramy 1L * 6 PCS_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 21 THEN prix_total_ht ELSE 0 END)) AS "(P) Ramy 2 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 35 THEN prix_total_ht ELSE 0 END)) AS "(P) Frutty Kids 20 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 15 THEN prix_total_ht ELSE 0 END)) AS "(P) Frutty 20 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 16 THEN prix_total_ht ELSE 0 END)) AS "(P) Frutty 1 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 31 THEN prix_total_ht ELSE 0 END)) AS "(P) Frutty 2 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 43 THEN prix_total_ht ELSE 0 END)) AS "(P) Frutty 1L * 6 PCS_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 38 THEN prix_total_ht ELSE 0 END)) AS "UP 125 ML18 *BTS_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 33 THEN prix_total_ht ELSE 0 END)) AS "UP 20 CL 18 BTS_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1061 THEN prix_total_ht ELSE 0 END)) AS "Milky 30 cl_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1341 THEN prix_total_ht ELSE 0 END)) AS "Milky 20 cl_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1461 THEN prix_total_ht ELSE 0 END)) AS "MILKY20 CL 18 PCS_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 1351 THEN prix_total_ht ELSE 0 END)) AS "Milky 1 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 19 THEN prix_total_ht ELSE 0 END)) AS "Pepsi 25 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 20 THEN prix_total_ht ELSE 0 END)) AS "Pepsi 33 CL_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 23 THEN prix_total_ht ELSE 0 END)) AS "Pepsi 1 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 24 THEN prix_total_ht ELSE 0 END)) AS "Pepsi 1,25 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 25 THEN prix_total_ht ELSE 0 END)) AS "Pepsi 1,5 L_C.A",
                    formatReadableQuantity(SUM(CASE WHEN article_famille_id = 26 THEN prix_total_ht ELSE 0 END)) AS "Pepsi 2 L_C.A",
                    formatReadableQuantity(SUM(prix_total_ht)) AS "Total-montant"
                    FROM clickhouse_new_stats_new s
                    WHERE s.mouvement_type_id = 2
                    AND s.route_id IN
                        ( 16711,1010,1107,12011,15731,11981,15761,11971,15771,11961,15781,11951,15791,11941,15801,11931,15811,11921,15821,1108,12151,15591,12141,15601,12131,15611,12121,15621,12111,15631,12101,15641,12031,15711,12001,15741,1109,12211,15531,12201,15541,12191,15551,12181,15561,12171,15571,17051,17351,12021,15721,11991,15751,17261,17271,17281,16711,1011,1104,11791,15951,11761,15981,11731,16011,11721,16021,11711,16031,11701,16041,11691,16051,11681,16061,1105,12091,15651,12081,15661,12071,15671,12061,15681,12051,15691,12041,15701,11771,15971,11741,16001,1111,11911,15831,11901,15841,11891,15851,11881,15861,11871,15871,11861,15881,11781,15961,11751,15991,17111,17121,17131,16701,1013,1118,12611,15131,12581,15161,12551,15191,12541,15201,12531,15211,12521,15221,12511,15231,12501,15241,1119,12661,15081,12651,15091,12631,15111,12621,15121,12601,15141,12591,15151,12571,15171,12561,15181,1120,12731,15011,12721,15021,12711,15031,12701,15041,12691,15051,12681,15061,12671,15071,12641,15101,17231,17241,17251,16701,1015,1128,13241,14501,13211,14531,13141,14601,13131,14611,13111,14631,13101,14641,13091,14651,19071,19081,1129,13261,14481,13231,14511,13201,14541,13191,14551,13181,14561,13171,14571,13161,14581,13151,14591,1130,13321,14421,13311,14431,13301,14441,13291,14451,13281,14461,13271,14471,13251,14491,13221,14521,17061,17071,19841,16711,1016,1113,15891,11851,15901,11841,11831,15911,11821,15921,11811,15931,11801,15941,11671,16071,11641,16101,1114,11661,16081,11651,16091,11631,16111,11621,16121,11611,16131,11601,16141,11581,16161,11571,16171,1127,11591,16151,11561,16181,11551,16191,11541,16201,11531,16211,11521,16221,11511,16231,11501,16241,17371,17081,17301,17311,16711,18911,19051,17091,17101,18931,13081,14661,13071,14671,13061,14681,13051,14691,13041,14701,13031,14711,12311,15431,12281,15461,18941,12331,15411,12321,15421,12301,15441,12291,15451,12271,15471,12261,15481,12241,15501,12231,15511,18951,12791,14951,12781,14961,12771,14971,12761,14981,12751,14991,12741,15001,12251,15491,12221,15521,1001,19621,1106,17291,18841,13751,13991,13691,14051,17451,17481,17761,17791,18181,18211,18851,13791,13951,17321,17331,17771,17801,17781,18861,16641,16651,17421,17471,18871,19001,19041,13621,16521,13611,14131,13531,14211,13481,14261,13441,14301,13431,14311,13401,14341,13121,14621,16291,16301,16551,16771,16781,16791,16801,16811,16841,16851,16881,16891,16901,16911,16921,16931,16981,16991,17021,17031,17041,17851,17911,18001,18091,18011,18101,18021,18111,18031,18131,18041,18061,18051,18121,18161,18191,18201,18241,18261,18271,18281,18311,18321,18331,18341,18351,18361,18371,18381,18391,18401,18411,18421,18431,18441,18451,18461,18471,18481,18491,18501,18511,18531,18541,18551,18561,18571,18581,18591,18601,18611,18621,18631,18641,18651,18661,18671,18681,18691,18701,18711,18721,18731,18741,18751,19631,1001,19641,19651,20451,20471,1110,18301,20251,19311,19321,19331,19341,19381,19391,19481,19491,19521,19531,19541,19551,19561,19571,1112,16941,16951,18151,20221,18171,20211,19461,19471,19681,19691,19701,19711,19871,19881,20231,20241,1121,19721,19741,19731,19751,19761,19781,19771,19791,19801,19821,19811,19831,20171,20181,20191,20201,1122,19421,19431,19441,19451,19661,19671,20261,20311,20271,20321,20281,20331,20291,20341,20301,20351,1131,19191,19201,19211,19221,19231,19251,19241,19261,19271,19291,19281,19301,19351,19361,19851,19861,18961,19401,19411,19501,19511,19581,19591,19601,19611,20361,20401,20371,20411,20381,20421,20391,20431)
                    AND s.date_depart >= \'2024-09-30\'
                    AND s.date_depart <= \'2024-10-28\'
                    GROUP BY zone, zone_designation;';

        $results = DB::connection('clickhouse')->select($query);


    return response()->json($results);


});


Route::get("getusers1", function() {

    /** @var \ClickHouseDB\Client $db */
        $db = DB::connection('clickhouse')->getClient();

        $query = 'SELECT
                    s.zone ,
                    s.zone_id,
                    article_famille_id, article_famille_designation,
                    formatReadableQuantity(SUM(prix_total_ht)) AS Total_montant
                    FROM clickhouse_new_stats_new s
                    WHERE s.mouvement_type_id = 2
                    AND s.route_id IN
                        ( 16711,1010,1107,12011,15731,11981,15761,11971,15771,11961,15781,11951,15791,11941,15801,11931,15811,11921,15821,1108,12151,15591,12141,15601,12131,15611,12121,15621,12111,15631,12101,15641,12031,15711,12001,15741,1109,12211,15531,12201,15541,12191,15551,12181,15561,12171,15571,17051,17351,12021,15721,11991,15751,17261,17271,17281,16711,1011,1104,11791,15951,11761,15981,11731,16011,11721,16021,11711,16031,11701,16041,11691,16051,11681,16061,1105,12091,15651,12081,15661,12071,15671,12061,15681,12051,15691,12041,15701,11771,15971,11741,16001,1111,11911,15831,11901,15841,11891,15851,11881,15861,11871,15871,11861,15881,11781,15961,11751,15991,17111,17121,17131,16701,1013,1118,12611,15131,12581,15161,12551,15191,12541,15201,12531,15211,12521,15221,12511,15231,12501,15241,1119,12661,15081,12651,15091,12631,15111,12621,15121,12601,15141,12591,15151,12571,15171,12561,15181,1120,12731,15011,12721,15021,12711,15031,12701,15041,12691,15051,12681,15061,12671,15071,12641,15101,17231,17241,17251,16701,1015,1128,13241,14501,13211,14531,13141,14601,13131,14611,13111,14631,13101,14641,13091,14651,19071,19081,1129,13261,14481,13231,14511,13201,14541,13191,14551,13181,14561,13171,14571,13161,14581,13151,14591,1130,13321,14421,13311,14431,13301,14441,13291,14451,13281,14461,13271,14471,13251,14491,13221,14521,17061,17071,19841,16711,1016,1113,15891,11851,15901,11841,11831,15911,11821,15921,11811,15931,11801,15941,11671,16071,11641,16101,1114,11661,16081,11651,16091,11631,16111,11621,16121,11611,16131,11601,16141,11581,16161,11571,16171,1127,11591,16151,11561,16181,11551,16191,11541,16201,11531,16211,11521,16221,11511,16231,11501,16241,17371,17081,17301,17311,16711,18911,19051,17091,17101,18931,13081,14661,13071,14671,13061,14681,13051,14691,13041,14701,13031,14711,12311,15431,12281,15461,18941,12331,15411,12321,15421,12301,15441,12291,15451,12271,15471,12261,15481,12241,15501,12231,15511,18951,12791,14951,12781,14961,12771,14971,12761,14981,12751,14991,12741,15001,12251,15491,12221,15521,1001,19621,1106,17291,18841,13751,13991,13691,14051,17451,17481,17761,17791,18181,18211,18851,13791,13951,17321,17331,17771,17801,17781,18861,16641,16651,17421,17471,18871,19001,19041,13621,16521,13611,14131,13531,14211,13481,14261,13441,14301,13431,14311,13401,14341,13121,14621,16291,16301,16551,16771,16781,16791,16801,16811,16841,16851,16881,16891,16901,16911,16921,16931,16981,16991,17021,17031,17041,17851,17911,18001,18091,18011,18101,18021,18111,18031,18131,18041,18061,18051,18121,18161,18191,18201,18241,18261,18271,18281,18311,18321,18331,18341,18351,18361,18371,18381,18391,18401,18411,18421,18431,18441,18451,18461,18471,18481,18491,18501,18511,18531,18541,18551,18561,18571,18581,18591,18601,18611,18621,18631,18641,18651,18661,18671,18681,18691,18701,18711,18721,18731,18741,18751,19631,1001,19641,19651,20451,20471,1110,18301,20251,19311,19321,19331,19341,19381,19391,19481,19491,19521,19531,19541,19551,19561,19571,1112,16941,16951,18151,20221,18171,20211,19461,19471,19681,19691,19701,19711,19871,19881,20231,20241,1121,19721,19741,19731,19751,19761,19781,19771,19791,19801,19821,19811,19831,20171,20181,20191,20201,1122,19421,19431,19441,19451,19661,19671,20261,20311,20271,20321,20281,20331,20291,20341,20301,20351,1131,19191,19201,19211,19221,19231,19251,19241,19261,19271,19291,19281,19301,19351,19361,19851,19861,18961,19401,19411,19501,19511,19581,19591,19601,19611,20361,20401,20371,20411,20381,20421,20391,20431)
                    AND s.date_depart >= \'2024-09-30\'
                    AND s.date_depart <= \'2024-10-28\'
                    GROUP BY ALL ;
                    ';

        $results = DB::connection('clickhouse')->select($query);


    return response()->json($results);


});

// re2

Route::get("getusers2", function() {

    /** @var \ClickHouseDB\Client $db */
        $db = DB::connection('clickhouse')->getClient();

        $query = 'SELECT client_id, client, SUM(prix_total_ht) AS total
            FROM clickhouse_new_stats_new s
            WHERE s.mouvement_type_id = 2
            GROUP BY ALL
            ';

        $results = DB::connection('clickhouse')->select($query);


    return response()->json($results);


});

// SELECT article_famille_id, article_famille_designation, SUM(prix_total_ht) AS total
// FROM clickhouse_new_stats_new s
// WHERE s.mouvement_type_id = 2
// GROUP BY article_famille_id, article_famille_designation;



// req3

Route::get("getusers3", function() {

    /** @var \ClickhouseDb\Client $db*/

    $query = 'SELECT
                SUM(article_quantite) as "total_quantite",
                SUM(prix_total_ht) as "total_prix_ht",
                article_famille_id as "article_famille_id",
                zone_id
            FROM
                clickhouse_new_stats_new s
            WHERE
                    s.date_depart >= \'2024-09-30\'
                    AND s.date_depart <= \'2024-10-28\'
            group by
                article_famille_id,
                zone_id
            order by
                article_famille_id asc,
                zone_id asc
    ';

    $results = DB::connection('clickhouse')->select($query);

    return response()->json($results);

});


// req4

Route::get("getusers4", function() {

    /** @var \ClickhouseDb\Client $db*/

    $query = 'SELECT
                SUM(article_quantite) as "total_quantite",
                SUM(prix_total_ht) as "total_prix_ht",
                article_famille_id as "article_famille_id",
                zone_id
            FROM
                clickhouse_new_stats_new s
            WHERE
                    s.date_depart >= \'2024-09-30\'
                    AND s.date_depart <= \'2024-10-28\'
            group by
                article_famille_id,
                zone_id
            order by
                article_famille_id asc,
                zone_id asc
    ';

    $results = DB::connection('clickhouse')->select($query);

    return response()->json($results);

});


// add more qureies











// get users2. the same querey but with mysql



Route::get("getusers222", function() {


    $query= "

SELECT
    s.zone AS zone_designation,
    s.zone_id AS zone,
    FORMAT(SUM(CASE WHEN article_famille_id = 1561 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Pallet_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1111 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Vita C+ 33 cl_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1261 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Power Fruits 33 Cl_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1361 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Jetable Jus 25 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1371 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Jetable Lacté 25 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 39 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Donuts 27 Pcs_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1421 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Jiji 20 GR_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1431 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Jiji 30 GR_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1501 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(B) Smarty_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1551 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Milky Kids 125 ML_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 40 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Donuts 09 Pcs_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '04_Extra 30 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 2 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '05_Ramy 1,25 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 3 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '05_Extra 1,25 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 4 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '06_Ramy 2 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 5 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '06_Extra 2 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1141 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Frutty 1,25 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 7 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '08_Frutty 2 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 8 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '02_Maltée 33 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 9 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '03_Energétique 33 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 10 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '01_Jus 24 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 11 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(C) Gazeifie 33 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 12 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(C) Maltée 33 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 45 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Water Fruits 33 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 42 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Gazéifié 33 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 6 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '16_Kids 125 ML_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 47 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Water Fruits 1 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 13 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Ramy 20 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 14 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Ramy 1 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 41 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Ramy 1L * 6 PCS_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 21 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Ramy 2 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 35 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Frutty Kids 20 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 15 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Frutty 20 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 16 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Frutty 1 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 31 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Frutty 2 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 43 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS '(P) Frutty 1L * 6 PCS_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 38 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'UP 125 ML18 *BTS_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 33 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'UP 20 CL 18 BTS_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1061 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Milky 30 cl_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1341 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Milky 20 cl_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1461 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'MILKY20 CL 18 PCS_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 1351 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Milky 1 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 19 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Pepsi 25 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 20 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Pepsi 33 CL_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 23 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Pepsi 1 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 24 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Pepsi 1,25 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 25 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Pepsi 1,5 L_C.A',
    FORMAT(SUM(CASE WHEN article_famille_id = 26 THEN prix_total_ht ELSE 0 END), 0, 'ru_RU') AS 'Pepsi 2 L_C.A',
    FORMAT(SUM(prix_total_ht), 0, 'ru_RU') AS 'Total-montant'
FROM new_stats_new s
WHERE s.mouvement_type_id = 2

  AND s.date_depart >= '2024-09-30'
  AND s.date_depart <= '2024-10-28'

  AND s.route_id IN

      ( 16711,1010,1107,12011,15731,11981,15761,11971,15771,11961,15781,11951,15791,11941,15801,11931,15811,11921,15821,1108,12151,15591,12141,15601,12131,15611,12121,15621,12111,15631,12101,15641,12031,15711,12001,15741,1109,12211,15531,12201,15541,12191,15551,12181,15561,12171,15571,17051,17351,12021,15721,11991,15751,17261,17271,17281,16711,1011,1104,11791,15951,11761,15981,11731,16011,11721,16021,11711,16031,11701,16041,11691,16051,11681,16061,1105,12091,15651,12081,15661,12071,15671,12061,15681,12051,15691,12041,15701,11771,15971,11741,16001,1111,11911,15831,11901,15841,11891,15851,11881,15861,11871,15871,11861,15881,11781,15961,11751,15991,17111,17121,17131,16701,1013,1118,12611,15131,12581,15161,12551,15191,12541,15201,12531,15211,12521,15221,12511,15231,12501,15241,1119,12661,15081,12651,15091,12631,15111,12621,15121,12601,15141,12591,15151,12571,15171,12561,15181,1120,12731,15011,12721,15021,12711,15031,12701,15041,12691,15051,12681,15061,12671,15071,12641,15101,17231,17241,17251,16701,1015,1128,13241,14501,13211,14531,13141,14601,13131,14611,13111,14631,13101,14641,13091,14651,19071,19081,1129,13261,14481,13231,14511,13201,14541,13191,14551,13181,14561,13171,14571,13161,14581,13151,14591,1130,13321,14421,13311,14431,13301,14441,13291,14451,13281,14461,13271,14471,13251,14491,13221,14521,17061,17071,19841,16711,1016,1113,15891,11851,15901,11841,11831,15911,11821,15921,11811,15931,11801,15941,11671,16071,11641,16101,1114,11661,16081,11651,16091,11631,16111,11621,16121,11611,16131,11601,16141,11581,16161,11571,16171,1127,11591,16151,11561,16181,11551,16191,11541,16201,11531,16211,11521,16221,11511,16231,11501,16241,17371,17081,17301,17311,16711,18911,19051,17091,17101,18931,13081,14661,13071,14671,13061,14681,13051,14691,13041,14701,13031,14711,12311,15431,12281,15461,18941,12331,15411,12321,15421,12301,15441,12291,15451,12271,15471,12261,15481,12241,15501,12231,15511,18951,12791,14951,12781,14961,12771,14971,12761,14981,12751,14991,12741,15001,12251,15491,12221,15521,1001,19621,1106,17291,18841,13751,13991,13691,14051,17451,17481,17761,17791,18181,18211,18851,13791,13951,17321,17331,17771,17801,17781,18861,16641,16651,17421,17471,18871,19001,19041,13621,16521,13611,14131,13531,14211,13481,14261,13441,14301,13431,14311,13401,14341,13121,14621,16291,16301,16551,16771,16781,16791,16801,16811,16841,16851,16881,16891,16901,16911,16921,16931,16981,16991,17021,17031,17041,17851,17911,18001,18091,18011,18101,18021,18111,18031,18131,18041,18061,18051,18121,18161,18191,18201,18241,18261,18271,18281,18311,18321,18331,18341,18351,18361,18371,18381,18391,18401,18411,18421,18431,18441,18451,18461,18471,18481,18491,18501,18511,18531,18541,18551,18561,18571,18581,18591,18601,18611,18621,18631,18641,18651,18661,18671,18681,18691,18701,18711,18721,18731,18741,18751,19631,1001,19641,19651,20451,20471,1110,18301,20251,19311,19321,19331,19341,19381,19391,19481,19491,19521,19531,19541,19551,19561,19571,1112,16941,16951,18151,20221,18171,20211,19461,19471,19681,19691,19701,19711,19871,19881,20231,20241,1121,19721,19741,19731,19751,19761,19781,19771,19791,19801,19821,19811,19831,20171,20181,20191,20201,1122,19421,19431,19441,19451,19661,19671,20261,20311,20271,20321,20281,20331,20291,20341,20301,20351,1131,19191,19201,19211,19221,19231,19251,19241,19261,19271,19291,19281,19301,19351,19361,19851,19861,18961,19401,19411,19501,19511,19581,19591,19601,19611,20361,20401,20371,20411,20381,20421,20391,20431)





GROUP BY s.zone, s.zone_id;
";



    $results = DB::connection('mysql')->select($query);
    return response()->json($results);


});

