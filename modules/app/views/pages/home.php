<?php
    include('./modules/app/models/home.php');
?>
    <div id="main" class="container">
        <div id="container_daily" class="row my-5 mx-auto">
            <div class="col-10 mx-auto">
                <div class="row">
                    <h4 class="text-center mx-auto">Najbolji kurs evra danas</h4>
                </div>
                <div class="row">
            <?php
                foreach($res as $key => $row) {
            ?>
            <div class="col">
                <div class="card my-5 mx-auto">
                    <div class="card-body">
                        <div class="card-text mx-auto text-center">
                                <?php
                                    echo $row['exchange_office_name'] . ",<br>" . $row['exchange_office_location'] . "<br>" . $row['sell_rate'];
                                ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
                </div>            
            </div>
        </div>
        <div id="container" class="row text-center my-5">
            <table id="currency_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Menjacnica</th>
                        <th scope="col" class="text-center">Prodajni Evro</th>
                        <th scope="col" class="text-center">Srednji Evro</th>
                        <th scope="col" class="text-center">Kupovni Evro</th>
                        <th scope="col" class="text-center">Kontakt</th>
                        <th scope="col" class="text-center">Lokacija</th>
                        <th scope="col" class="text-center">Kursna lista</th>
                    </tr>
                </thead>
                <?php
                    include('./modules/app/models/search_box.php"');
                ?>
                <tbody id="container_table" style="display: none;">
                </tbody>
                <tbody id="currency_body">
            <?php
                for($i = 0; $i < count($names); $i++) {
                    
            ?>
                <tr class="text-center">
                    <td class="align-middle">
                        <?= $names[$i]; ?>
                    </td>
                    <td class="align-middle">
                        <?php echo getRate($ids[$i], "sell");?>                    
                    </td>
                    <td class="align-middle">
                        <?php echo getRate($ids[$i], "avg");?>                    
                    </td>
                    <td class="align-middle">
                        <?php echo getRate($ids[$i], "buy");?>                    
                    </td>
                    <td class="align-middle">
                        <?= $phones[$i] . "<br>"; ?>                    
                    
                        <?= $emails[$i]; ?>                    
                    </td>
                    <td id="location" class="align-middle">
                        <?php
                            echo getLocations($ids[$i])[0];
                        ?>
                    </td>
                    <td class="align-middle">
                        <a href="index.php?page=profile&id=<?php echo $ids[$i]; ?>" class="badge badge-dark" style='font-size: 0.9rem;'>Detaljniji pogled</a>
                    </td>
                </tr>
            <?php
                }
            ?>
                </tbody>
            </table>
            
        </div>
    </div>
    
   
    