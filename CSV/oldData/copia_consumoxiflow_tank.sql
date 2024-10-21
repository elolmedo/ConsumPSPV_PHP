--
-- PostgreSQL database dump
--

-- Dumped from database version 14.4 (Ubuntu 14.4-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.4 (Ubuntu 14.4-0ubuntu0.22.04.1)

-- Started on 2022-08-10 18:02:28 CEST

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3376 (class 0 OID 16489)
-- Dependencies: 212
-- Data for Name: consumoxiflow_tank; Type: TABLE DATA; Schema: pspv_schema; Owner: rom_pspv
--

COPY pspv_schema.consumoxiflow_tank (mes, temporada, consum_tank, id_preu, id) FROM stdin;
Gener	2012	6979.91	1	348
Febrer	2012	6979.05	1	349
Març	2012	7659.35	1	350
Abril	2012	7584.1	1	351
Maig	2012	8466.93	1	352
Juny	2012	6855.49	1	353
Juliol	2012	6301.96	1	354
Agost	2012	7695.11	1	355
Setempre	2012	5793	1	356
Octubre	2012	7654.13	1	357
Novembre	2012	6290.04	1	358
Decembre	2012	6363.07	1	359
Gener	2013	7471.09	1	360
Febrer	2013	8215.86	1	361
Març	2013	7259.28	1	362
Abril	2013	7493.21	1	363
Maig	2013	7332.49	1	364
Juny	2013	6621.56	1	365
Juliol	2013	8891.58	1	366
Agost	2013	7602.73	1	367
Setempre	2013	6198.4	1	368
Octubre	2013	8328.35	1	369
Novembre	2013	6620.07	1	370
Decembre	2013	8743.32	1	371
Gener	2014	10792.33	1	372
Febrer	2014	8881.89	1	373
Març	2014	7259.28	1	374
Abril	2014	7493.21	1	375
Maig	2014	7332.49	1	376
Juny	2014	8231.51	1	377
Juliol	2014	7156.47	1	378
Agost	2014	8393.17	1	379
Setempre	2014	7688.4	1	380
Octubre	2014	8648.02	1	381
Novembre	2014	6607.41	1	382
Decembre	2014	8743.32	1	383
Gener	2015	8973.27	1	384
Febrer	2015	9571.05	1	385
Març	2015	11718.85	1	386
Abril	2015	9576.23	1	387
Juny	2015	8580.17	1	388
Juliol	2015	6754.17	1	389
Agost	2015	7748	1	390
Septembre	2015	8364.12	1	391
Octubre	2015	8584.64	1	392
Novembre	2015	9426.49	1	393
Decembre	2015	11499.82	1	394
Maig	2015	9036	1	395
Gener	2016	10927.7	5	396
Febrer	2016	10767.49	5	397
Març	2016	11108.7	5	398
Abril	2016	10707.89	5	399
Maig	2016	11736.73	5	400
Juny	2016	8577.93	5	401
Juliol	2016	8499.71	5	402
Agost	2016	8344.75	5	403
Septembre	2016	11093.05	5	404
Octubre	2016	9311.76	5	405
Novembre	2016	10260.9	5	406
Decembre	2016	10369.66	5	407
Gener	2017	13314.65	5	408
Febrer	2017	11707.28	5	409
Març	2017	12194.91	5	410
Abril	2017	12799.85	5	411
Mayo	2017	14581.89	5	412
Juny	2017	11212.99	5	413
Juliol	2017	9129.89	5	414
Agost	2017	9515.89	5	415
Septembre	2017	10542.5	5	416
Octubre	2017	11832.84	5	417
Novembre	2017	12012.39	5	418
Decembre	2017	12645.63	5	419
Gener	2018	13731.84	5	420
Febrer	2018	12344.65	5	421
Març	2018	13082	5	422
Abril	2018	13429.37	5	423
Maig	2018	13787.72	5	424
Juny	2018	10243.01	5	425
Juliol	2018	11160.11	5	426
Agost	2018	18402.98	5	427
Septembre	2018	10003.12	5	428
Octubre	2018	11540.05	5	429
Novembre	2018	11626.47	5	430
Desembre	2018	9979.28	5	431
Gener	2019	13705.77	5	432
Febrer	2019	11914.04	5	433
Març	2019	14055.17	5	434
Abril	2019	12918.3	5	435
Maig	2019	12649.36	5	436
Juny	2019	10432.84	5	437
Juliol	2019	11179.47	5	438
Agost	2019	9224.59	5	439
Septembre	2019	10342.84	5	440
Octubre	2019	13281.8	5	441
Novembre	2019	12410.21	5	442
Decembre	2019	13468.11	5	443
Gener	2020	13280.05	5	444
Febrer	2020	12784.46	5	445
Març	2020	14734.61	5	446
Abril	2020	20711	5	447
Maig	2020	11317.3	5	448
Juny	2020	11242.8	5	449
Juliol	2020	11952.78	5	450
Agost	2020	12123.39	5	451
Septembre	2020	13604.45	5	452
Octubre	2020	13281.8	5	453
Novembre	2020	15244.19	5	454
Decembre	2020	16622.4	5	455
Gener	2021	16794.54	5	456
Febrer	2021	13773.56	5	457
Març	2021	15507.45	5	458
Abril	2021	16458.37	5	459
Maig	2021	14247.38	5	460
Juny	2021	6875.61	5	461
Juliol	2021	10406.91	5	462
Agost	2021	13248.34	5	463
Septembre	2021	11281.55	5	464
Octubre	2021	12742.48	5	465
Novembre	2021	15060.18	5	466
Decembre	2021	16734.94	5	467
\.


--
-- TOC entry 3383 (class 0 OID 0)
-- Dependencies: 213
-- Name: consumoxiflow_tank_id_seq; Type: SEQUENCE SET; Schema: pspv_schema; Owner: rom_pspv
--

SELECT pg_catalog.setval('pspv_schema.consumoxiflow_tank_id_seq', 352, true);


-- Completed on 2022-08-10 18:02:28 CEST

--
-- PostgreSQL database dump complete
--

