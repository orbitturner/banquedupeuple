<?php
    require_once 'db.php';

    //==================|OPERATION DE DEPOT|==================
    function depot($montant, $type='DEPOT', $idCompte, $idUser){
        $num = opNumGen('DEP');
        global $db;
        $date = Date('d-m-Y');
        $req = "INSERT INTO operation VALUES (null, '$num','$date','$montant','$type','$idCompte','$idUser','OK', 1)";

        if ($db->exec($req) > 0){
            $sql = "UPDATE compte SET solde=solde+$montant WHERE id=$idCompte ";
            return $db->exec($sql);
        }
    }

    //==================|OPERATION DE RETRAIT|==================
    function retrait($montant, $type='RETRAIT', $idCompte, $idUser){
        $num = opNumGen('RET');
        global $db;
        $date = Date('d-m-Y');
        $req = "INSERT INTO operation VALUES (null, '$num','$date','$montant','$type','$idCompte','$idUser','OK', 1)";

        if ($db->exec($req) > 0){
            $sql = "UPDATE compte SET solde=solde-$montant WHERE id=$idCompte ";
            return $db->exec($sql);
        }
    }

    //==================|GENERATION NUMERO OPERATION|==================    
    function virement($idCompteDebit, $idCompteCredit, $montant, $type='VIREMENT', $idUser){
        $num = opNumGen('VIR');
        global $db;
        $date = Date('d-m-Y');
        $details = "Debité de: ".$idCompteDebit." - Crédité à :".$idCompteCredit;
        $req = "INSERT INTO operation VALUES (null, '$num','$date','$montant','$type','$idCompteDebit','$idUser','$details', 1)";
        
        if ($db->exec($req) > 0){
            $sql = "UPDATE compte SET solde=solde-$montant WHERE id=$idCompteDebit";
            $sql1 = "UPDATE compte SET solde=solde+$montant WHERE id=$idCompteCredit";
            if ($db->exec($sql) > 0) {
                return $db->exec($sql1);
            }

        }
    }

    //==================|GENERATION NUMERO OPERATION|==================    
    function opNumGen($typeOp){

        global $db;
        $date = Date('dmY');
        // $request = "SELECT max(id) FROM operation";
        $req = $db ->query ('SELECT max(id) FROM operation')->fetchColumn();
        // echo $req;
        //Create a Method for generating an Operation Number with sprintf like "OP-jjMmAn-lastid[select last id from]+1
        $codeOp = sprintf("%s-%s-%d", $typeOp, $date, $req+1);
        return $codeOp;
    }

    
   
?>