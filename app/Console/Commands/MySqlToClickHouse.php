<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MySqlToClickHouse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:my-sql-to-click-house';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract data from MySQL and load into ClickHouse';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Extract data from MySQL
        // $mysqlData = DB::connection('mysql')->table('new_stats_new')->get();

        // chose a database

        DB::connection('clickhouse')->statement('USE bivente');

        // Create table in ClickHouse (if not exists)
        DB::connection('clickhouse')->statement("CREATE TABLE IF NOT EXISTS etl (
                                                    mouvement_ligne_id UInt64,
                                                    mouvement_id UInt64,
                                                    mouvement_numero_complet String DEFAULT '',
                                                    date_depart Date,
                                                    date_commande Date,
                                                    mouvement_type_id UInt64 DEFAULT 0,
                                                    vendeur_id UInt64 DEFAULT 0,
                                                    vendeur String DEFAULT '',
                                                    vehicule_id UInt64 DEFAULT 0,
                                                    vehicule String DEFAULT '',
                                                    client_id UInt64 DEFAULT 0,
                                                    client String DEFAULT '',
                                                    client_reference String DEFAULT '',
                                                    client_type_id UInt64 DEFAULT 0,
                                                    client_type String DEFAULT '',
                                                    client_wilaya_id UInt64 DEFAULT 0,
                                                    client_wilaya String DEFAULT '',
                                                    region_id UInt64 DEFAULT 0,
                                                    region String DEFAULT '',
                                                    zone_id UInt64 DEFAULT 0,
                                                    zone String DEFAULT '',
                                                    secteur_id UInt64 DEFAULT 0,
                                                    secteur String DEFAULT '',
                                                    route_id UInt64 DEFAULT 0,
                                                    route String DEFAULT '',
                                                    tournee_id UInt64 DEFAULT 0,
                                                    tournee String DEFAULT '',
                                                    article_id UInt64 DEFAULT 0,
                                                    article_designation String DEFAULT '',
                                                    article_reference String DEFAULT '',
                                                    article_unite String DEFAULT '',
                                                    article_famille_id UInt64 DEFAULT 0,
                                                    article_famille_designation String DEFAULT '',
                                                    article_quantite Float64 DEFAULT 0.0,
                                                    prix_uniaire_ht Float64 DEFAULT 0.0,
                                                    fournisseur_id UInt64 DEFAULT 0,
                                                    fournisseur String DEFAULT '',
                                                    entreprise_id UInt64 DEFAULT 0,
                                                    domain_user String DEFAULT '',
                                                    domain_designation String DEFAULT '',
                                                    created_at DateTime
                                                ) ENGINE = MergeTree()
                                                ORDER BY (client_id, date_depart, vendeur_id);
        ");

        // Load data into ClickHouse

        DB::connection('mysql')->table('new_stats_new')->orderBy('mouvement_ligne_id')->chunk(1000, function ($rows) {
            $data = [];

            foreach ($rows as $row) {
                $data[] = [
                    'mouvement_ligne_id' => $row->mouvement_ligne_id,
                    'mouvement_id' => $row->mouvement_id,
                    'mouvement_numero_complet' => $row->mouvement_numero_complet,
                    'date_depart' => $row->date_depart,
                    'date_commande' => $row->date_commande,
                    'mouvement_type_id' => $row->mouvement_type_id,
                    'vendeur_id' => $row->vendeur_id,
                    'vendeur' => $row->vendeur,
                    'vehicule_id' => $row->vehicule_id,
                    'vehicule' => $row->vehicule,
                    'client_id' => $row->client_id,
                    'client' => $row->client,
                    'client_reference' => $row->client_reference,
                    'client_type_id' => $row->client_type_id,
                    'client_type' => $row->client_type,
                    'client_wilaya_id' => $row->client_wilaya_id,
                    'client_wilaya' => $row->client_wilaya,
                    'region_id' => $row->region_id,
                    'region' => $row->region,
                    'zone_id' => $row->zone_id,
                    'zone' => $row->zone,
                    'secteur_id' => $row->secteur_id,
                    'secteur' => $row->secteur,
                    'route_id' => $row->route_id,
                    'route' => $row->route,
                    'tournee_id' => $row->tournee_id,
                    'tournee' => $row->tournee,
                    'article_id' => $row->article_id,
                    'article_designation' => $row->article_designation,
                    'article_reference' => $row->article_reference,
                    'article_unite' => $row->article_unite,
                    'article_famille_id' => $row->article_famille_id,
                    'article_famille_designation' => $row->article_famille_designation,
                    'article_quantite' => $row->article_quantite,
                    'prix_uniaire_ht' => $row->prix_uniaire_ht,
                    'fournisseur_id' => $row->fournisseur_id,
                    'fournisseur' => $row->fournisseur,
                    'entreprise_id' => $row->entreprise_id,
                    'domain_user' => $row->domain_user,
                    'domain_designation' => $row->domain_designation,
                    'created_at' => $row->created_at,
                ];
            }

            // Insert chunk into ClickHouse
            DB::connection('clickhouse')->table('etl')->insert($data);
        });

        $this->info('ETL process completed successfully.');


        // cretae a materilize view for stats by clients

        DB::connection('clickhouse')->statement('
            CREATE MATERIALIZED VIEW IF NOT EXISTS stats_by_clients
            ENGINE = AggregatingMergeTree()
            ORDER BY client_id
            POPULATE
            AS
            SELECT
                client_id,
                client,
                client_reference,
                client_type,
                client_wilaya,
                region,
                zone,
                secteur,
                route,
                tournee,
                article_designation,
                article_reference,
                article_unite,
                article_famille_designation,
                SUM(article_quantite) AS total_quantite,
                SUM(prix_uniaire_ht) AS total_prix_ht,
                MIN(date_depart) AS date_depart
            FROM etl
            GROUP BY
                client_id,
                client,
                client_reference,
                client_type,
                client_wilaya,
                region,
                zone,
                secteur,
                route,
                tournee,
                article_designation,
                article_reference,
                article_unite,
                article_famille_designation
        ');





// compoare the query with and without the view

"

// create a view for stats by clients

CREATE TABLE IF NOT EXISTS stats_by_clients (
                client_id UInt64,
                client Nullable(String),
                client_reference Nullable(String),
                client_type Nullable(String),
                total_quantite Float64,
                total_prix_ht Float64,
            ) ENGINE = SummingMergeTree()
             ORDER BY client_id


CREATE MATERIALIZED VIEW stats_by_clients_mv TO stats_by_clients AS
            SELECT
                client_id,
                client,
                client_reference,
                client_type,
                SUM(article_quantite) AS total_quantite,
                SUM(prix_uniaire_ht) AS total_prix_ht

            FROM etl

            GROUP BY
                client_id


INSERT INTO stats_by_clients
            SELECT
                client_id,
                client,
                client_reference,
                client_type,
                SUM(article_quantite) AS total_quantite,
                SUM(prix_uniaire_ht) AS total_prix_ht

            FROM etl

            GROUP BY
                client_id,
                client,
                client_reference,
                client_type

            "








    }




}







"
CREATE TABLE IF NOT EXISTS netl (
                mouvement_ligne_id UInt64,
                mouvement_id Nullable(UInt64),
                mouvement_numero_complet Nullable(String),
                date_depart Date,
                date_commande Date,
                mouvement_type_id Nullable(UInt64),
                vendeur_id UInt64,
                vendeur Nullable(String),
                vehicule_id Nullable(UInt64),
                vehicule Nullable(String),
                client_id UInt64,
                client Nullable(String),
                client_reference Nullable(String),
                client_type_id Nullable(UInt64),
                client_type Nullable(String),
                client_wilaya_id Nullable(UInt64),
                client_wilaya Nullable(String),
                region_id Nullable(UInt64),
                region Nullable(String),
                zone_id Nullable(UInt64),
                zone Nullable(String),
                secteur_id Nullable(UInt64),
                secteur Nullable(String),
                route_id Nullable(UInt64),
                route Nullable(String),
                tournee_id Nullable(UInt64),
                tournee Nullable(String),
                article_id Nullable(UInt64),
                article_designation Nullable(String),
                article_reference Nullable(String),
                article_unite Nullable(String),
                article_famille_id Nullable(UInt64),
                article_famille_designation Nullable(String),
                article_quantite Nullable(Float64),
                prix_uniaire_ht Nullable(Float64),
                fournisseur_id UInt64,
                fournisseur Nullable(String),
                entreprise_id Nullable(UInt64),
                domain_user Nullable(String),
                domain_designation Nullable(String),
                created_at DateTime

            ) ENGINE = MergeTree()
            ORDER BY (client_id, fournisseur_id, vendeur_id, date_depart)

            "




"
