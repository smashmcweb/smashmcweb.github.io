<?php
$h = "localhost";
$u = "root";
$p = "";
$d = "minecraft";

$c = new mysqli($h, $u, $p, $d);

if ($c->connect_error) {
    die("<tr><td colspan='4' style='text-align:center; padding:2rem; color:red;'>Errore connessione Database</td></tr>");
}

$q = "SELECT name, reason, operator, punishmentType FROM Punishments WHERE punishmentType LIKE '%BAN%' ORDER BY id DESC";
$res = $c->query($q);

if ($res && $res->num_rows > 0) {
    while($r = $res->fetch_assoc()) {
        $t = $r["punishmentType"];
        $s = (strpos($t, 'TEMP') !== false) 
            ? 'background: rgba(234, 179, 8, 0.2); color: #eab308; border: 1px solid rgba(234, 179, 8, 0.3);' 
            : 'background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);';
        
        echo "<tr style='background: rgba(0, 0, 0, 0.4); transition: 0.3s;'>
                <td style='padding: 1rem; border-radius: 1rem 0 0 1rem; border-top: 1px solid rgba(255,255,255,0.05);'>
                    <div style='display: flex; align-items: center; gap: 0.75rem;'>
                        <img src='https://mc-heads.net/avatar/".$r["name"]."/30' style='border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.5);'>
                        <span style='font-weight: 700; color: white; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;'>".$r["name"]."</span>
                    </div>
                </td>
                <td style='padding: 1rem; border-top: 1px solid rgba(255,255,255,0.05); font-size: 0.75rem; color: #9ca3af; font-weight: 500;'>".$r["reason"]."</td>
                <td style='padding: 1rem; border-top: 1px solid rgba(255,255,255,0.05); font-size: 0.75rem; font-weight: 700; color: #eee;'>".$r["operator"]."</td>
                <td style='padding: 1rem; border-radius: 0 1rem 1rem 0; border-top: 1px solid rgba(255,255,255,0.05); text-align: right;'>
                    <span style='font-weight: 900; text-transform: uppercase; font-size: 9px; padding: 5px 12px; border-radius: 6px; letter-spacing: 1px; ".$s."'>".$t."</span>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4' style='text-align: center; padding: 5rem; color: #4b5563; font-weight: 800; text-transform: uppercase; letter-spacing: 3px;'>Nessun Ban Registrato</td></tr>";
}
$c->close();
?>