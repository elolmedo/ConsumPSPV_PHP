<head>

    <style>
        body {
        }

        ul.nav-pills {
            position: fixed;
        }

        div.col-sm-9 div {
            height: 250px;
            font-size: 28px;
        }

        #section1 {
            color: #fff;
            background-color: #1E88E5;
            padding: 5%;
        }

        #section2 {
            color: #fff;
            background-color: #673ab7;
            padding: 5%;
        }

        #section3 {
            color: #fff;
            background-color: #ff9800;
            padding: 5%;
        }

        #section4 {
            color: #fff;
            background-color: #00bcd4;
            padding: 5%;
        }

        #section5 {
            color: #fff;
            background-color: #009688;
            padding: 5%;
        }
        #section6 {
            color: #fff;
            background-color: #919619;
            padding: 5%;
        }

        @media screen and (max-width: 810px) {
            #section1, #section2, #section3, #section41, #section42 {
                margin-left: 150px;
            }
        }
    </style>
</head>
<script>
	$("#homeImage").hide();						  
</script>
<div class="container" data-spy="scroll" data-target="#myScrollspy" data-offset="20">
    <div class="row">
        <nav class="col-md-3" id="myScrollspy">


            <ul class="nav nav-pills nav-stacked">

                <li><a href="#section1">Objectius</a></li>
                <li><a href="#section2">Totals 1 (Oxigen Tank, Aigua i Electricitat)</a></li>
                <li><a href="#section3">Totals 2 (Gas Natural i Oxigen Ampolles)</a></li>
                <li><a href="#section4">Insercio</a></li>
                <li><a href="#section5">Ultimes Insercions</a> </li>
                <li><a href="#section6">Contacte</a> </li>

            </ul>
        </nav>
        <div class="col-md-9">
            <div id="section1">
                <h1>Objectius</h1>
                <p>L'aplicació té com objectiu principal mostrar les dades més importants del consums de subministres
                    del Parc Sanitari Pere Virgili(PSPV)</p>
                <ul>
                    <li>Consums d'aigua</li>
                    <li>Gas natural</li>
                    <li>Electricitat</li>
                    <li>Oxigen tank</li>
                    <li>Oxigen ampolles</li>

                </ul>
                <p>Per això té automatitzat l'inserció de dades de tots els consums, amb dades especifiques o acordades
                    que veurem més endavant.
                    Per tenir una aplicació accesible des de diferents sistemes o llocs se ha creat una aplicació
                    web</p>
            </div>
            <div id="section2">
                <h1>Totals 1 (Oxigen Tank, Aigua i Electricitat)</h1>
                <p>En aquest apartat podem veure dos tipus de dades, per consum en la seva mesura apropiada y cost del
                    suministre</p>

                <h2>Dades per Consum</h2>
                <p>Tipus de consulta: Consum</p>

                <h3>Oxigen</h3>
                <p>Taula Totals: Consum total per any d Oxigen tank. Obtenim la suma de totes les insercions de Oxigen
                    mensual separedes per anys</p>
                <p>Grafica: Es podem veure els diferents consums durant tot l any</p>

                <h3>Electricitat</h3>
                <p>Taula Totals: Consum total per any d electricitat. Obtenim la suma de totes les insercions de
                    periodes de consums electrics mensual separats per anys</p>
                <p>Grafica: Es podem veure els diferents totals de periodes mensuals durant tot l any</p>

                <h3>Aigua</h3>
                <p>Taula Totals: Consum total per any d aigua. Obtenim la suma de totes les insercions de trams de
                    consums mensual separats per anys</p>
                <p>Grafica: Es podem veure els diferents otals de trams mensuals durant tot l any</p>

                <h2>Dades per Cost</h2>
                <p>Tipus de consulta: PMP</p>

                <h3>Oxigen</h3>
                <p>Taula Totals: Cost total per any d Oxigen tank. Obtenim la suma de totes les insercions de Oxigen
                    mensual separedes per anys mensual separats per anys i les multipliquem per seu preu, el resultat
                    els dividim entre 1.000</p>
                <p> Consum anual * preu / 1000</p>
                <p>Grafica: Es podem veure els diferents consums durant tot l any</p>

                <h3>Electricitat</h3>
                <p>Taula Totals: Preu mitg poderat per any d electricitat. Obtenim el total de factures per any i
                el dividim entre la suma totals de consums anuals</p>
                <p>Grafica: Es podem veure els diferents pmp del consum electric durant tot l any</p>
                <p> Per any: total Factures / total periodes consums</p>
                <p> Per mes: total Factura / total consum periodes mensuals</p>

                <h3>Aigua</h3>
                <p>Taula Totals: Preu mitg poderat per any d aigua. Obtenim el total de factures per any i
                    el dividim entre la suma totals de consums anuals</p>
                <p>Grafica: Es podem veure els diferents pmp del consum aigua durant tot l any</p>
                <p> Per any: total Factures / total trams consums</p>
                <p> Per mes: total Factura / total consum trams mensuals</p>

            </div>
            <div id="section3">
                <h1>Totals 2 (Gas Natural i Oxigen Ampolles)</h1>
                <p>En aquest apartat podem veure dos tipus de dades, per consum en la seva mesura apropiada y cost del
                    suministre</p>
                <h2>Dades per Consum</h2>
                <p>Tipus de consulta: Consum</p>

                <h3>Gas Natural</h3>
                <h4>Edificis</h4>
                <p> Com que el parc te diferents contadors de Gas Natural, tindrem dades per cada contador i dades de
                tots els contadors junts</p>
                <p>Taula Totals per Edificis: Suma de les diferents entradas mensual del resultat de la diferencia
                entre lectura anterior i lectura actual, obtenim el total de kw consumits de gas natural per any</p>
                <p>Grafica per Edifics: podem veure el consum de gas natural durant tot l any per cada edifici</p>
                <h4>Totals</h4>
                <p>Taula Totals: Suma del tots el resultas anterior fets per edificis, obtenim el consum anual del parc
                en Gas Natural</p>
                <p>Grafica: podem veure el consum de gas natural total de cada edifici</p>

                <h3>Oxigen ampolles</h3>
                <h4>Edificis</h4>
                <p>Com que el parc utilitza aquestes ampolles en diferents edificis, tindrem dades per cada edifici i
                el total de consum d ampolles d oxigen que consumeix el parc.</p>
                <p>Taula Totals per Edificis: Suma de les diferents entradas mensual del consum de ampolles, obtenim el total
                    de ampolles consumits any i per edifici</p>
                <p>Grafica per Edifics: podem veure el consum d ampolles oxigen durant tot l any per cada edifici</p>
                <h4>Totals</h4>
                <p>Taula Totals: Suma del tots el resultas anterior fets per edificis, obtenim el consum anual del parc
                    en Oxigen ampolles</p>
                <p>Grafica: podem veure el consum d oxigen ampolles total de cada edifici</p>

                <h2>Dades per Cost</h2>
                <p>Tipus de consulta: PMP</p>

                <h3>Gas Natural</h3>
                <h4>Edificis</h4>
                <p> Com que el parc te diferents contadors de Gas Natural, tindrem dades per cada contador i dades de
                    tots els contadors junts</p>
                <p>Taula Totals per Edificis: Obtenim el valor anual en € multiplican el resultat de la resta (lectura anterior - lectura actual)
                per el preu i per valor de convercio</p>
                <p>(Lectura actual - lectura anterior) * preu * valor convercio</p>
                <p>Grafica per edificis: Cost mensual durant els anys establerts </p>
                <h4>Totals</h4>
                <p>Taula Totals: Suma del tots el resultas anterior fets per edificis, obtenim el cost anual del parc
                    en Gas Natural</p>
                <p>Grafica: podem veure el consum de gas natural total de cada edifici</p>

                <h3>Oxigen ampolles</h3>
                <h4>Edificis</h4>
                <p>Com que el parc utilitza aquestes ampolles en diferents edificis, tindrem dades per cada edifici i
                    el total de consum d ampolles d oxigen que consumeix el parc.</p>
                <p>Taula Totals per Edificis: Suma de les diferents entradas mensual del consum de ampolles multiplicades per el preu de compra
                    , obtenim el total   de ampolles consumits any i per edifici en €</p>
                <p>Grafica per Edifics: podem veure el cost de les ampolles oxigen durant tot l any per cada edifici</p>
                <h4>Totals</h4>
                <p>Taula Totals: Suma del tots el resultas anterior fets per edificis, obtenim el cost anual del parc
                    en Oxigen ampolles</p>
                <p>Grafica: podem veure el cost d oxigen ampolles total de cada edifici</p>

            </div>

            <div id="section4">
                <h1>Insercions</h1>
                <p>A l apartat insercions tenim tots el formularis per introduir les nostres mesures de suministres, alguns d aquests
                incorporen un boto per poder crear un nou preu, ja sigui per Gas Natural, oxigen ampolles o oxigen tank</p>
                <h2>Insercio nou preu</h2>
                <p>Una vegada en pulsat el boto de insertar nou preu, accedim a un nou formulari amb el seguents camps:</p>
                <ul>
                    <li>Tipus: Actualment nomes pot ser PREU</li>
                    <li>Consum: Gas Natural, Oxigen Tank o Oxiflow ampolles </li>
                    <li>Cantitat: Insertem en nou preu</li>
                    <li>Descripcio: Data del nou preu, perque s ha canviat, etc.</li>
                </ul>

                <p>Despres de fer la insercion de la nova dada, ja la podrem visualitzar i utilizar mitjanaçant el seu id</p>

                <h2>A tenir en compte</h2>
                <p>Tots els camps del formularis han de ser rellenats, en cas de no tenir ningu valor a introduir posarem un 0/p>
            </div>
            <div id="section5">
                <h1>Ultimes Insercions</h1>
                <p>En aquest apartat podem veure les ultimes insercions fetes a la base de dades, podem seleccionar entre el diferentes consums.</p>
            </div>
            <div id="section6">
                <h1>Contacte</h1>
                <h2>RomSolutions</h2>
                <p>Raul Olmedo</p>
                <a mailto="raulolmedom@gmail.com"><p>raulolmedom@gmail.com</p></a>
                <p>telf. 609520548</p>
            </div>

        </div>
    </div>
</div>

