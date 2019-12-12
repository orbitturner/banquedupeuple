<?php


    require_once('modelOperation.php');
    //==================|CREATION D'UN CLIENT|==================    
    function insererClient($cni, $nom, $prenom, $adresse, $tel){
        global $db;

        $request = "INSERT INTO client Values (null,'$cni','$nom','$prenom', '$adresse','$tel')";

        $db->exec($request);
        //Exec renvoi le nombre de ligne inseré
        return $db->lastInsertId();
        //Renvoi le dernier Identifiant Insérer au niveau de la table specifie
    }

    //==================|CREATION D'UN COMPTE|==================    
    function ajouterCompte($solde, $idCli, $idUser){
        $numCompte = accountNumGen();
        global $db;
        $date = Date('d-m-Y');
        $req = "INSERT into compte VALUES (null, '$numCompte', '$date', 0, $idCli, $idUser,1)";
        
        $db->exec($req);

        $idCompte = $db->lastInsertId();

        //test if the request has been executed 
        if ($idCompte > 0) {
           return depot($solde, 'DEPOT',$idCompte, $idUser);
        }
        
    }   

    //==================|GENERATION NUMERO COMPTE|==================    
    function accountNumGen(){

        global $db;
        $date = Date('mY');
        $req = $db ->query ('SELECT max(id) FROM compte')->fetchColumn();

        //Generate an AccountNumber as "TDTSB-MoisAnnee-lastIdCompte[select max(id) from compte]+1"
        $codeAccount = sprintf("DTSB-%s-%d", $date, $req+1);
        return $codeAccount;
    }

    //IL EST PAS POSSIBLE DE METTRE LA RECUPERATION DE LA LISTE ICI CAR UNE SESSION EST DEJA STARTED!

    //==================|TROUVER UN COMPTE PAR SON NUM|==================    
    function findAccountByNum($numero){
        $sql = "SELECT * FROM compte WHERE numero='$numero'";
        
        global $db;

        return $db->query($sql)->fetch();
    }
?>
