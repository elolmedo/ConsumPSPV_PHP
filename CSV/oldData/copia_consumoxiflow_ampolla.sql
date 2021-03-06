--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3 (Ubuntu 10.3-1)
-- Dumped by pg_dump version 10.3 (Ubuntu 10.3-1)

-- Started on 2020-01-30 11:25:16 CET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2989 (class 0 OID 16904)
-- Dependencies: 197
-- Data for Name: consumoxiflow_ampolla; Type: TABLE DATA; Schema: pspv_schema; Owner: rom_pspv
--

COPY pspv_schema.consumoxiflow_ampolla (mes, temporada, id_edifici, planta_edifici, id_preu, num_botellas, id) FROM stdin;
Gener	2012	GRE	1	4	4	554
Gener	2012	GRE	2	4	0	555
Febrer	2012	GRE	1	4	3	556
Febrer	2012	GRE	2	4	6	557
Març	2012	GRE	1	4	10	558
Març	2012	GRE	2	4	22	559
Abril	2012	GRE	1	4	0	560
Abril	2012	GRE	2	4	20	561
Maig	2012	GRE	1	4	0	562
Maig	2012	GRE	2	4	16	563
Juny	2012	GRE	1	4	1	564
Juny	2012	GRE	2	4	11	565
Juliol	2012	GRE	2	4	7	566
Juliol	2012	GRE	2	4	18	567
Agost	2012	GRE	1	4	3	568
Agost	2012	GRE	2	4	15	569
Septembre	2012	GRE	1	4	4	570
Septembre	2012	GRE	2	4	12	571
Octubre	2012	GRE	1	4	5	572
Octubre	2012	GRE	2	4	23	573
Novembre	2012	GRE	1	4	4	574
Novembre	2012	GRE	2	4	11	575
Decembre	2012	GRE	1	4	1	576
Decembre	2012	GRE	2	4	21	577
Gener	2012	LLE	1	4	13	578
Gener	2012	LLE	2	4	20	579
Gener	2012	LLE	3	4	10	580
Gener	2012	LLE	4	4	8	581
Gener	2012	LLE	5	4	1	582
Febrer	2012	LLE	1	4	6	583
Febrer	2012	LLE	2	4	30	584
Febrer	2012	LLE	3	4	36	585
Febrer	2012	LLE	4	4	10	586
Febrer	2012	LLE	5	4	28	587
Març	2012	LLE	1	4	5	588
Març	2012	LLE	2	4	16	589
Març	2012	LLE	3	4	34	590
Març	2012	LLE	4	4	21	591
Març	2012	LLE	5	4	5	592
Abril	2012	LLE	1	4	28	593
Abril	2012	LLE	2	4	8	594
Abril	2012	LLE	3	4	14	595
Abril	2012	LLE	4	4	19	596
Abril	2012	LLE	5	4	1	597
Maig	2012	LLE	1	4	30	598
Maig	2012	LLE	2	4	9	599
Maig	2012	LLE	3	4	22	600
Maig	2012	LLE	4	4	13	601
Maig	2012	LLE	5	4	0	602
Juny	2012	LLE	1	4	11	603
Juny	2012	LLE	2	4	8	604
Juny	2012	LLE	3	4	20	605
Juny	2012	LLE	4	4	25	606
Juny	2012	LLE	5	4	1	607
Juliol	2012	LLE	1	4	36	608
Juliol	2012	LLE	2	4	2	609
Juliol	2012	LLE	3	4	36	610
Juliol	2012	LLE	4	4	6	611
Juliol	2012	LLE	5	4	2	612
Agost	2012	LLE	1	4	17	613
Agost	2012	LLE	2	4	0	614
Agost	2012	LLE	3	4	34	615
Agost	2012	LLE	4	4	6	616
Agost	2012	LLE	5	4	2	617
Septembre	2012	LLE	1	4	14	618
Septembre	2012	LLE	2	4	2	619
Septembre	2012	LLE	3	4	1	620
Septembre	2012	LLE	4	4	5	621
Septembre	2012	LLE	5	4	0	622
Octubre	2012	LLE	1	4	22	623
Octubre	2012	LLE	2	4	1	624
Octubre	2012	LLE	3	4	10	625
Octubre	2012	LLE	4	4	16	626
Octubre	2012	LLE	5	4	8	627
Novembre	2012	LLE	1	4	16	628
Novembre	2012	LLE	2	4	6	629
Novembre	2012	LLE	3	4	21	630
Novembre	2012	LLE	4	4	14	631
Novembre	2012	LLE	5	4	4	632
Decembre	2012	LLE	1	4	33	633
Decembre	2012	LLE	2	4	31	634
Decembre	2012	LLE	3	4	14	635
Decembre	2012	LLE	4	4	14	636
Decembre	2012	LLE	5	4	4	637
Gener	2012	XAL	1	4	32	638
Gener	2012	XAL	2	4	16	639
Gener	2012	XAL	3	4	17	640
Gener	2012	XAL	4	4	37	641
Febrer	2012	XAL	1	4	5	642
Febrer	2012	XAL	2	4	27	643
Febrer	2012	XAL	3	4	19	644
Febrer	2012	XAL	4	4	19	645
Març	2012	XAL	1	4	0	646
Març	2012	XAL	2	4	20	647
Març	2012	XAL	3	4	39	648
Març	2012	XAL	4	4	15	649
Abril	2012	XAL	1	4	1	650
Abril	2012	XAL	2	4	37	651
Abril	2012	XAL	3	4	70	652
Abril	2012	XAL	4	4	13	653
Maig	2012	XAL	1	4	0	654
Maig	2012	XAL	2	4	7	655
Maig	2012	XAL	3	4	73	656
Maig	2012	XAL	4	4	0	657
Juny	2012	XAL	1	4	3	658
Juny	2012	XAL	2	4	70	659
Juny	2012	XAL	3	4	35	660
Juny	2012	XAL	4	4	1	661
Juliol	2012	XAL	1	4	2	662
Juliol	2012	XAL	2	4	51	663
Juliol	2012	XAL	3	4	8	664
Juliol	2012	XAL	4	4	0	665
Agost	2012	XAL	1	4	1	666
Agost	2012	XAL	2	4	5	667
Agost	2012	XAL	3	4	56	668
Agost	2012	XAL	4	4	10	669
Septembre	2012	XAL	1	4	17	670
Septembre	2012	XAL	2	4	16	671
Septembre	2012	XAL	3	4	16	672
Septembre	2012	XAL	4	4	0	673
Octubre	2012	XAL	1	4	4	674
Octubre	2012	XAL	2	4	31	675
Octubre	2012	XAL	3	4	14	676
Octubre	2012	XAL	4	4	27	677
Novembre	2012	XAL	1	4	3	678
Novembre	2012	XAL	2	4	21	679
Novembre	2012	XAL	3	4	23	680
Novembre	2012	XAL	4	4	10	681
Decembre	2012	XAL	1	4	6	682
Decembre	2012	XAL	2	4	14	683
Decembre	2012	XAL	3	4	40	684
Decembre	2012	XAL	4	4	16	685
Gener	2013	GRE	1	4	1	686
Gener	2013	GRE	2	4	16	687
Febrer	2013	GRE	1	4	4	688
Febrer	2013	GRE	2	4	16	689
Març	2013	GRE	1	4	5	690
Març	2013	GRE	2	4	14	691
Abril	2013	GRE	1	4	0	692
Abril	2013	GRE	2	4	16	693
Maig	2013	GRE	1	4	0	694
Maig	2013	GRE	2	4	15	695
Juny	2013	GRE	1	4	2	696
Juny	2013	GRE	2	4	13	697
Juliol	2013	GRE	2	4	18	698
Juliol	2013	GRE	2	4	9	699
Agost	2013	GRE	1	4	0	700
Agost	2013	GRE	2	4	36	701
Septembre	2013	GRE	1	4	3	702
Septembre	2013	GRE	2	4	22	703
Octubre	2013	GRE	1	4	2	704
Octubre	2013	GRE	2	4	46	705
Novembre	2013	GRE	1	4	1	706
Novembre	2013	GRE	2	4	27	707
Decembre	2013	GRE	1	4	1	708
Decembre	2013	GRE	2	4	29	709
Gener	2013	LLE	1	4	14	710
Gener	2013	LLE	2	4	49	711
Gener	2013	LLE	3	4	25	712
Gener	2013	LLE	4	4	13	713
Gener	2013	LLE	5	4	2	714
Febrer	2013	LLE	1	4	8	715
Febrer	2013	LLE	2	4	58	716
Febrer	2013	LLE	3	4	33	717
Febrer	2013	LLE	4	4	8	718
Febrer	2013	LLE	5	4	3	719
Març	2013	LLE	1	4	7	720
Març	2013	LLE	2	4	25	721
Març	2013	LLE	3	4	14	722
Març	2013	LLE	4	4	5	723
Març	2013	LLE	5	4	1	724
Abril	2013	LLE	1	4	23	725
Abril	2013	LLE	2	4	1	726
Abril	2013	LLE	3	4	10	727
Abril	2013	LLE	4	4	24	728
Abril	2013	LLE	5	4	2	729
Maig	2013	LLE	1	4	7	730
Maig	2013	LLE	2	4	12	731
Maig	2013	LLE	3	4	7	732
Maig	2013	LLE	4	4	23	733
Maig	2013	LLE	5	4	1	734
Juny	2013	LLE	1	4	7	735
Juny	2013	LLE	2	4	6	736
Juny	2013	LLE	3	4	4	737
Juny	2013	LLE	4	4	14	738
Juny	2013	LLE	5	4	1	739
Juliol	2013	LLE	1	4	28	740
Juliol	2013	LLE	2	4	0	741
Juliol	2013	LLE	3	4	11	742
Juliol	2013	LLE	4	4	37	743
Juliol	2013	LLE	5	4	0	744
Agost	2013	LLE	1	4	25	745
Agost	2013	LLE	2	4	9	746
Agost	2013	LLE	3	4	16	747
Agost	2013	LLE	4	4	14	748
Agost	2013	LLE	5	4	0	749
Septembre	2013	LLE	1	4	43	750
Septembre	2013	LLE	2	4	9	751
Septembre	2013	LLE	3	4	13	752
Septembre	2013	LLE	4	4	27	753
Septembre	2013	LLE	5	4	1	754
Octubre	2013	LLE	1	4	49	755
Octubre	2013	LLE	2	4	4	756
Octubre	2013	LLE	3	4	13	757
Octubre	2013	LLE	4	4	12	758
Octubre	2013	LLE	5	4	5	759
Novembre	2013	LLE	1	4	17	760
Novembre	2013	LLE	2	4	0	761
Novembre	2013	LLE	3	4	20	762
Novembre	2013	LLE	4	4	6	763
Novembre	2013	LLE	5	4	12	764
Decembre	2013	LLE	1	4	13	765
Decembre	2013	LLE	2	4	12	766
Decembre	2013	LLE	3	4	10	767
Decembre	2013	LLE	4	4	15	768
Decembre	2013	LLE	5	4	8	769
Gener	2013	XAL	1	4	4	770
Gener	2013	XAL	2	4	15	771
Gener	2013	XAL	3	4	41	772
Gener	2013	XAL	4	4	2	773
Febrer	2013	XAL	1	4	6	774
Febrer	2013	XAL	2	4	17	775
Febrer	2013	XAL	3	4	68	776
Febrer	2013	XAL	4	4	7	777
Març	2013	XAL	1	4	3	778
Març	2013	XAL	2	4	10	779
Març	2013	XAL	3	4	21	780
Març	2013	XAL	4	4	2	781
Abril	2013	XAL	1	4	0	782
Abril	2013	XAL	2	4	12	783
Abril	2013	XAL	3	4	41	784
Abril	2013	XAL	4	4	10	785
Maig	2013	XAL	1	4	8	786
Maig	2013	XAL	2	4	7	787
Maig	2013	XAL	3	4	3	788
Maig	2013	XAL	4	4	8	789
Juny	2013	XAL	1	4	17	790
Juny	2013	XAL	2	4	1	791
Juny	2013	XAL	3	4	26	792
Juny	2013	XAL	4	4	30	793
Juliol	2013	XAL	1	4	6	794
Juliol	2013	XAL	2	4	5	795
Juliol	2013	XAL	3	4	14	796
Juliol	2013	XAL	4	4	25	797
Agost	2013	XAL	1	4	0	798
Agost	2013	XAL	2	4	0	799
Agost	2013	XAL	3	4	4	800
Agost	2013	XAL	4	4	22	801
Septembre	2013	XAL	1	4	7	802
Septembre	2013	XAL	2	4	7	803
Septembre	2013	XAL	3	4	24	804
Septembre	2013	XAL	4	4	33	805
Octubre	2013	XAL	1	4	8	806
Octubre	2013	XAL	2	4	8	807
Octubre	2013	XAL	3	4	36	808
Octubre	2013	XAL	4	4	34	809
Novembre	2013	XAL	1	4	0	810
Novembre	2013	XAL	2	4	10	811
Novembre	2013	XAL	3	4	49	812
Novembre	2013	XAL	4	4	37	813
Decembre	2013	XAL	1	4	1	814
Decembre	2013	XAL	2	4	25	815
Decembre	2013	XAL	3	4	12	816
Decembre	2013	XAL	4	4	95	817
Gener	2014	GRE	1	4	22	818
Gener	2014	GRE	2	4	7	819
Febrer	2014	GRE	1	4	17	820
Febrer	2014	GRE	2	4	0	821
Març	2014	GRE	1	4	19	822
Març	2014	GRE	2	4	3	823
Abril	2014	GRE	1	4	26	824
Abril	2014	GRE	2	4	2	825
Maig	2014	GRE	1	4	23	826
Maig	2014	GRE	2	4	0	827
Juny	2014	GRE	1	4	31	828
Juny	2014	GRE	2	4	0	829
Juliol	2014	GRE	2	4	42	830
Juliol	2014	GRE	2	4	0	831
Agost	2014	GRE	1	4	30	832
Agost	2014	GRE	2	4	0	833
Septembre	2014	GRE	1	4	18	834
Septembre	2014	GRE	2	4	0	835
Octubre	2014	GRE	1	4	31	836
Octubre	2014	GRE	2	4	0	837
Novembre	2014	GRE	1	4	30	838
Novembre	2014	GRE	2	4	0	839
Decembre	2014	GRE	1	4	45	840
Decembre	2014	GRE	2	4	0	841
Gener	2014	LLE	1	4	16	842
Gener	2014	LLE	2	4	8	843
Gener	2014	LLE	3	4	77	844
Gener	2014	LLE	4	4	17	845
Gener	2014	LLE	5	4	3	846
Febrer	2014	LLE	1	4	39	847
Febrer	2014	LLE	2	4	24	848
Febrer	2014	LLE	3	4	40	849
Febrer	2014	LLE	4	4	10	850
Febrer	2014	LLE	5	4	11	851
Març	2014	LLE	1	4	22	852
Març	2014	LLE	2	4	45	853
Març	2014	LLE	3	4	33	854
Març	2014	LLE	4	4	20	855
Març	2014	LLE	5	4	11	856
Abril	2014	LLE	1	4	24	857
Abril	2014	LLE	2	4	52	858
Abril	2014	LLE	3	4	33	859
Abril	2014	LLE	4	4	44	860
Abril	2014	LLE	5	4	11	861
Maig	2014	LLE	1	4	24	862
Maig	2014	LLE	2	4	52	863
Maig	2014	LLE	3	4	33	864
Maig	2014	LLE	4	4	44	865
Maig	2014	LLE	5	4	5	866
Juny	2014	LLE	1	4	2	867
Juny	2014	LLE	2	4	9	868
Juny	2014	LLE	3	4	29	869
Juny	2014	LLE	4	4	42	870
Juny	2014	LLE	5	4	2	871
Juliol	2014	LLE	1	4	17	872
Juliol	2014	LLE	2	4	23	873
Juliol	2014	LLE	3	4	35	874
Juliol	2014	LLE	4	4	36	875
Juliol	2014	LLE	5	4	2	876
Agost	2014	LLE	1	4	40	877
Agost	2014	LLE	2	4	3	878
Agost	2014	LLE	3	4	14	879
Agost	2014	LLE	4	4	21	880
Agost	2014	LLE	5	4	4	881
Septembre	2014	LLE	1	4	23	882
Septembre	2014	LLE	2	4	5	883
Septembre	2014	LLE	3	4	6	884
Septembre	2014	LLE	4	4	13	885
Septembre	2014	LLE	5	4	2	886
Octubre	2014	LLE	1	4	12	887
Octubre	2014	LLE	2	4	5	888
Octubre	2014	LLE	3	4	8	889
Octubre	2014	LLE	4	4	13	890
Octubre	2014	LLE	5	4	0	891
Novembre	2014	LLE	1	4	14	892
Novembre	2014	LLE	2	4	0	893
Novembre	2014	LLE	3	4	12	894
Novembre	2014	LLE	4	4	18	895
Novembre	2014	LLE	5	4	3	896
Decembre	2014	LLE	1	4	16	897
Decembre	2014	LLE	2	4	6	898
Decembre	2014	LLE	3	4	15	899
Decembre	2014	LLE	4	4	13	900
Decembre	2014	LLE	5	4	3	901
Gener	2014	XAL	1	4	5	902
Gener	2014	XAL	2	4	8	903
Gener	2014	XAL	3	4	18	904
Gener	2014	XAL	4	4	81	905
Febrer	2014	XAL	1	4	0	906
Febrer	2014	XAL	2	4	20	907
Febrer	2014	XAL	3	4	29	908
Febrer	2014	XAL	4	4	53	909
Març	2014	XAL	1	4	2	910
Març	2014	XAL	2	4	12	911
Març	2014	XAL	3	4	54	912
Març	2014	XAL	4	4	65	913
Abril	2013	XAL	1	4	8	914
Abril	2014	XAL	2	4	6	915
Abril	2014	XAL	3	4	31	916
Abril	2014	XAL	4	4	74	917
Maig	2014	XAL	1	4	0	918
Maig	2014	XAL	2	4	4	919
Maig	2014	XAL	3	4	5	920
Maig	2014	XAL	4	4	27	921
Juny	2014	XAL	1	4	11	922
Juny	2014	XAL	2	4	13	923
Juny	2014	XAL	3	4	14	924
Juny	2014	XAL	4	4	24	925
Juliol	2014	XAL	1	4	7	926
Juliol	2014	XAL	2	4	13	927
Juliol	2014	XAL	3	4	11	928
Juliol	2014	XAL	4	4	21	929
Agost	2014	XAL	1	4	39	930
Agost	2014	XAL	2	4	23	931
Agost	2014	XAL	3	4	23	932
Agost	2014	XAL	4	4	0	933
Septembre	2014	XAL	1	4	1	934
Septembre	2014	XAL	2	4	22	935
Septembre	2014	XAL	3	4	19	936
Septembre	2014	XAL	4	4	30	937
Octubre	2014	XAL	1	4	1	938
Octubre	2014	XAL	2	4	11	939
Octubre	2014	XAL	3	4	39	940
Octubre	2014	XAL	4	4	46	941
Novembre	2014	XAL	1	4	0	942
Novembre	2014	XAL	2	4	0	943
Novembre	2014	XAL	3	4	39	944
Novembre	2014	XAL	4	4	33	945
Decembre	2014	XAL	1	4	10	946
Decembre	2014	XAL	2	4	6	947
Decembre	2014	XAL	3	4	27	948
Decembre	2014	XAL	4	4	28	949
Gener	2015	GRE	1	4	64	993
Gener	2015	GRE	2	4	16	994
Gener	2015	LLE	1	4	28	995
Gener	2015	LLE	2	4	15	996
Gener	2015	LLE	3	4	24	997
Gener	2015	LLE	4	4	9	998
Gener	2015	LLE	5	4	0	999
Gener	2015	XAL	1	4	5	1000
Gener	2015	XAL	2	4	15	1001
Gener	2015	XAL	3	4	42	1002
Gener	2015	XAL	4	4	26	1003
Febrer	2015	GRE	1	4	47	1004
Febrer	2015	GRE	2	4	0	1005
Febrer	2015	LLE	1	4	34	1006
Febrer	2015	LLE	2	4	15	1007
Febrer	2015	LLE	3	4	16	1008
Febrer	2015	LLE	4	4	5	1009
Febrer	2015	LLE	5	4	0	1010
Febrer	2015	XAL	1	4	11	1011
Febrer	2015	XAL	2	4	6	1012
Febrer	2015	XAL	3	4	43	1013
Febrer	2015	XAL	4	4	4	1014
Març	2015	GRE	1	4	47	1015
Març	2015	LLE	1	4	33	1016
Març	2015	LLE	2	4	22	1017
Març	2015	LLE	3	4	13	1018
Març	2015	LLE	4	4	30	1019
Març	2015	LLE	5	4	4	1020
Març	2015	XAL	1	4	21	1021
Març	2015	XAL	2	4	27	1022
Març	2015	XAL	3	4	29	1023
Març	2015	XAL	4	4	6	1024
Abril	2015	GRE	1	4	52	1025
Abril	2015	LLE	1	4	12	1026
Abril	2015	LLE	2	4	17	1027
Abril	2015	LLE	3	4	33	1028
Abril	2015	LLE	4	4	25	1029
Abril	2015	LLE	5	4	2	1030
Abril	2015	XAL	1	4	28	1031
Abril	2015	XAL	2	4	24	1032
Abril	2015	XAL	3	4	51	1033
Abril	2015	XAL	4	4	12	1034
Maig	2015	GRE	1	4	36	1035
Maig	2015	LLE	1	4	16	1036
Maig	2015	LLE	2	4	12	1037
Maig	2015	LLE	3	4	22	1038
Maig	2015	LLE	4	4	37	1039
Maig	2015	LLE	5	4	6	1040
Maig	2015	XAL	1	4	28	1041
Maig	2015	XAL	2	4	22	1042
Maig	2015	XAL	3	4	31	1043
Maig	2015	XAL	4	4	7	1044
Juny	2015	GRE	1	4	13	1045
Juny	2015	GRE	2	4	6	1046
Juny	2015	LLE	1	4	12	1047
Juny	2015	LLE	2	4	5	1048
Juny	2015	LLE	3	4	20	1049
Juny	2015	LLE	4	4	21	1050
Juny	2015	LLE	5	4	2	1051
Juny	2015	XAL	1	4	15	1052
Juny	2015	XAL	3	4	33	1054
Juny	2015	XAL	4	4	5	1055
Juny	2015	XAL	4	4	5	1056
Juliol	2015	GRE	2	4	4	1057
Juliol	2015	LLE	1	4	51	1058
Juliol	2015	LLE	2	4	17	1059
Juliol	2015	LLE	3	4	23	1060
Juliol	2015	LLE	4	4	40	1061
Juliol	2015	XAL	1	4	6	1062
Juliol	2015	XAL	2	4	4	1063
Juliol	2015	XAL	3	4	16	1064
Juliol	2015	XAL	4	4	18	1065
Agost	2015	GRE	2	4	3	1066
Agost	2015	LLE	1	4	37	1067
Agost	2015	LLE	2	4	7	1068
Agost	2015	LLE	3	4	11	1069
Agost	2015	LLE	4	4	6	1070
Agost	2015	LLE	5	4	1	1071
Agost	2015	XAL	2	4	3	1072
Agost	2015	XAL	3	4	6	1073
Agost	2015	XAL	4	4	4	1074
Septembre	2015	GRE	1	4	7	1075
Septembre	2015	LLE	1	4	42	1076
Septembre	2015	LLE	2	4	10	1077
Septembre	2015	LLE	3	4	7	1078
Septembre	2015	LLE	4	4	12	1079
Septembre	2015	XAL	1	4	6	1081
Septembre	2015	XAL	2	4	7	1082
Septembre	2015	XAL	3	4	21	1083
Septembre	2015	XAL	4	4	4	1084
Juny	2015	XAL	2	4	10	1053
Septembre	2015	XAL	5	4	3	1080
Octubre	2015	GRE	1	4	5	1085
Octubre	2015	GRE	2	4	7	1086
Octubre	2015	LLE	1	4	40	1087
Octubre	2015	LLE	2	4	14	1088
Octubre	2015	LLE	3	4	9	1089
Octubre	2015	LLE	4	4	21	1090
Octubre	2015	LLE	5	4	2	1091
Octubre	2015	XAL	1	4	19	1092
Octubre	2015	XAL	2	4	13	1093
Octubre	2015	XAL	3	4	11	1094
Octubre	2015	XAL	4	4	2	1095
Novembre	2015	GRE	2	4	1	1096
Novembre	2015	LLE	1	4	20	1097
Novembre	2015	LLE	2	4	20	1098
Novembre	2015	LLE	3	4	16	1099
Novembre	2015	LLE	4	4	15	1100
Novembre	2015	LLE	5	4	1	1101
Novembre	2015	XAL	1	4	5	1102
Novembre	2015	XAL	2	4	13	1103
Novembre	2015	XAL	3	4	27	1104
Novembre	2015	XAL	4	4	5	1105
Decembre	2015	GRE	1	4	15	1106
Decembre	2015	GRE	2	4	8	1107
Decembre	2015	LLE	1	4	12	1108
Decembre	2015	LLE	2	4	14	1109
Decembre	2015	LLE	3	4	13	1110
Decembre	2015	LLE	4	4	29	1111
Decembre	2015	LLE	5	4	4	1112
Decembre	2015	XAL	1	4	9	1113
Decembre	2015	XAL	2	4	11	1114
Decembre	2015	XAL	3	4	28	1115
Decembre	2015	XAL	4	4	8	1116
Gener	2015	GRE	2	4	7	1118
Gener	2016	LLE	1	6	16	1119
Gener	2015	LLE	5	4	2	1123
Gener	2017	GRE	1	6	3	1255
Gener	2017	GRE	2	6	1	1256
Gener	2017	LLE	1	6	16	1257
Gener	2017	LLE	2	6	10	1258
Gener	2017	LLE	3	6	23	1259
Gener	2017	GRE	4	6	15	1260
Gener	2017	GRE	5	6	3	1261
Gener	2017	XAL	1	6	5	1262
Gener	2017	XAL	2	6	28	1263
Gener	2017	XAL	3	6	11	1264
Gener	2017	XAL	4	6	9	1265
Gener	2017	GRE	1	6	3	1266
Gener	2016	GRE	1	6	3	1117
Febrer	2016	GRE	1	6	5	1128
Febrer	2016	GRE	2	6	9	1129
Febrer	2016	LLE	1	6	8	1130
Febrer	2016	LLE	2	6	42	1131
Febrer	2016	LLE	3	6	14	1132
Febrer	2016	LLE	4	6	5	1133
Febrer	2016	LLE	5	6	2	1134
Febrer	2016	XAL	1	6	3	1135
Febrer	2016	XAL	2	6	8	1136
Febrer	2016	GRE	3	6	34	1137
Març	2016	GRE	1	6	9	1138
Març	2016	GRE	2	6	17	1139
Març	2016	LLE	1	6	4	1140
Març	2016	LLE	2	6	29	1141
Març	2016	LLE	3	6	17	1142
Març	2016	LLE	4	6	2	1143
Març	2016	LLE	5	6	2	1144
Març	2016	XAL	1	6	16	1145
Març	2016	XAL	2	6	5	1146
Març	2016	XAL	3	6	14	1147
Març	2016	XAL	4	6	3	1148
Abril	2016	GRE	1	6	1	1149
Abril	2016	GRE	2	6	7	1150
Abril	2016	LLE	1	6	5	1151
Abril	2016	LLE	2	6	42	1152
Abril	2016	GRE	3	6	3	1153
Abril	2016	LLE	4	6	25	1154
Abril	2016	LLE	5	6	6	1155
Abril	2016	XAL	1	6	27	1156
Abril	2016	XAL	2	6	9	1157
Abril	2016	XAL	3	6	16	1158
Abril	2016	XAL	4	6	8	1159
Maig	2016	GRE	1	6	9	1160
Maig	2016	GRE	2	6	5	1161
Maig	2016	LLE	1	6	4	1162
Maig	2016	LLE	2	6	34	1163
Maig	2016	LLE	3	6	9	1164
Maig	2016	LLE	4	6	22	1165
Maig	2016	LLE	5	6	3	1166
Maig	2016	XAL	1	6	8	1167
Maig	2016	XAL	2	6	20	1168
Maig	2016	XAL	3	6	11	1169
Maig	2016	XAL	4	6	16	1170
Juny	2016	GRE	1	6	24	1171
Juny	2016	GRE	2	6	7	1172
Juny	2016	LLE	1	6	4	1173
Juny	2016	LLE	2	6	20	1174
Juny	2016	LLE	3	6	17	1175
Juny	2016	LLE	4	6	7	1176
Juny	2016	LLE	5	6	5	1177
Juny	2016	XAL	1	6	23	1178
Juny	2016	XAL	2	6	13	1179
Juny	2016	XAL	3	6	14	1180
Juny	2016	XAL	4	6	17	1181
Juliol	2016	GRE	1	6	11	1182
Juliol	2016	GRE	2	6	5	1183
Juliol	2016	LLE	1	6	12	1184
Juliol	2016	LLE	2	6	36	1185
Juliol	2016	LLE	3	6	14	1186
Agost	2016	LLE	4	6	0	1187
Juliol	2016	LLE	5	6	1	1188
Juliol	2016	XAL	1	6	42	1189
Juliol	2016	XAL	2	6	11	1190
Juliol	2016	XAL	3	6	6	1191
Juliol	2016	XAL	4	6	13	1192
Agost	2016	LLE	1	6	16	1200
Agost	2016	LLE	2	6	10	1201
Agost	2016	LLE	3	6	7	1202
Agost	2016	GRE	1	6	9	1203
Agost	2016	GRE	2	6	7	1204
Agost	2016	XAL	1	6	25	1205
Agost	2016	XAL	2	6	11	1206
Agost	2016	XAL	3	6	18	1207
Agost	2016	XAL	4	6	23	1208
Septembre	2016	GRE	1	6	3	1209
Septembre	2016	GRE	2	6	5	1210
Septembre	2016	LLE	1	6	11	1211
Septembre	2016	LLE	2	6	9	1212
Septembre	2016	LLE	3	6	15	1213
Septembre	2016	LLE	4	6	3	1214
Septembre	2016	LLE	5	6	6	1215
Septembre	2016	XAL	1	6	13	1216
Septembre	2016	XAL	2	6	3	1217
Septembre	2016	XAL	3	6	12	1218
Septembre	2016	XAL	4	6	27	1219
Octubre	2016	GRE	1	6	8	1220
Octubre	2016	GRE	2	6	3	1221
Octubre	2016	LLE	1	6	6	1222
Octubre	2016	LLE	2	6	20	1223
Octubre	2016	LLE	3	6	11	1224
Octubre	2016	LLE	4	6	8	1226
Octubre	2016	LLE	5	6	1	1227
Octubre	2016	XAL	1	6	3	1228
Octubre	2016	XAL	2	6	11	1229
Octubre	2016	XAL	3	6	13	1230
Octubre	2016	XAL	4	6	9	1231
Novembre	2016	GRE	1	6	8	1232
Novembre	2016	GRE	2	6	1	1233
Novembre	2016	LLE	1	6	3	1234
Novembre	2016	LLE	2	6	1	1235
Novembre	2016	LLE	3	6	3	1236
Novembre	2016	LLE	4	6	4	1237
Novembre	2016	LLE	5	6	2	1238
Novembre	2016	XAL	1	6	3	1239
Novembre	2016	XAL	2	6	22	1240
Novembre	2016	XAL	3	6	6	1241
Novembre	2016	XAL	4	6	3	1242
Decembre	2016	GRE	1	6	2	1243
Decembre	2016	GRE	2	6	1	1244
Decembre	2016	LLE	1	6	10	1245
Decembre	2016	GRE	1	6	3	1246
Decembre	2016	LLE	2	6	10	1247
Decembre	2016	LLE	3	6	5	1248
Decembre	2016	LLE	4	6	11	1249
Decembre	2016	LLE	5	6	3	1250
Decembre	2016	XAL	1	6	5	1251
Decembre	2016	XAL	2	6	35	1252
Gener	2016	LLE	2	6	10	1120
Gener	2016	LLE	3	6	25	1121
Gener	2016	LLE	4	6	15	1122
Gener	2016	XAL	1	6	5	1124
Gener	2016	XAL	2	6	10	1125
Gener	2016	XAL	3	6	11	1126
Gener	2016	XAL	4	6	9	1127
Decembre	2016	XAL	3	6	11	1253
Decembre	2016	XAL	4	6	3	1254
Gener	2016	GRE	2	6	1	1268
Gener	2016	LLE	5	6	3	1269
Febrer	2017	GRE	1	6	17	1270
Febrer	2017	GRE	2	6	25	1271
Febrer	2017	LLE	1	6	14	1272
Febrer	2017	LLE	2	6	20	1273
Febrer	2017	LLE	3	6	1	1274
Febrer	2017	LLE	4	6	17	1275
Febrer	2017	LLE	5	6	5	1276
Febrer	2017	XAL	1	6	3	1277
Febrer	2017	XAL	2	6	17	1278
Febrer	2017	XAL	3	6	5	1279
Febrer	2017	XAL	4	6	9	1280
Març	2017	GRE	1	6	32	1281
Març	2017	GRE	2	6	29	1282
Març	2017	LLE	1	6	10	1283
Març	2017	LLE	2	6	14	1284
Març	2017	LLE	3	6	4	1285
Març	2017	LLE	4	6	29	1286
Març	2017	LLE	5	6	5	1287
Març	2017	XAL	1	6	9	1288
Març	2017	XAL	2	6	7	1289
Març	2017	XAL	3	6	9	1290
Març	2017	XAL	4	6	14	1291
Abril	2017	GRE	1	6	19	1292
Abril	2017	GRE	2	6	8	1293
Abril	2017	LLE	1	6	3	1294
Abril	2017	LLE	2	6	3	1295
Abril	2017	LLE	3	6	6	1296
Abril	2017	LLE	4	6	38	1297
Abril	2017	LLE	5	6	2	1298
Abril	2017	XAL	1	6	3	1299
Abril	2017	XAL	2	6	8	1300
Abril	2017	XAL	3	6	18	1301
Abril	2017	XAL	4	6	34	1302
Maig	2017	GRE	1	6	16	1303
Maig	2017	GRE	2	6	12	1304
Maig	2017	LLE	1	6	3	1305
Maig	2017	LLE	2	6	11	1306
Maig	2017	LLE	3	6	26	1307
Maig	2017	LLE	4	6	8	1308
Maig	2017	XAL	1	6	5	1309
Maig	2017	XAL	2	6	16	1310
Maig	2017	XAL	3	6	17	1311
Maig	2017	XAL	4	6	14	1312
Septembre	2017	GRE	1	6	17	1313
Septembre	2017	GRE	2	6	3	1314
Septembre	2017	LLE	1	6	8	1315
Septembre	2017	LLE	2	6	18	1316
Septembre	2017	LLE	3	6	22	1317
Septembre	2017	LLE	4	6	17	1318
Septembre	2017	LLE	5	6	3	1319
Septembre	2017	XAL	1	6	19	1320
Septembre	2017	XAL	2	6	23	1321
Septembre	2017	XAL	3	6	17	1322
Septembre	2017	XAL	4	6	13	1323
Octubre	2017	GRE	1	6	13	1324
Octubre	2017	GRE	2	6	9	1325
Octubre	2017	LLE	1	6	7	1326
Octubre	2017	LLE	2	6	26	1327
Octubre	2017	LLE	3	6	10	1328
Octubre	2017	LLE	4	6	19	1329
Octubre	2017	XAL	1	6	11	1330
Octubre	2017	XAL	2	6	11	1331
Octubre	2017	XAL	3	6	14	1332
Octubre	2017	XAL	4	6	28	1333
Novembre	2017	GRE	1	6	5	1334
Novembre	2017	GRE	2	6	22	1335
Novembre	2017	LLE	1	6	10	1336
Novembre	2017	LLE	2	6	23	1337
Novembre	2017	LLE	2	6	23	1338
Novembre	2017	LLE	3	6	5	1339
Novembre	2017	LLE	4	6	10	1340
Novembre	2017	LLE	5	6	2	1341
Novembre	2017	XAL	1	6	7	1342
Novembre	2017	XAL	2	6	19	1343
Novembre	2017	XAL	3	6	13	1344
Novembre	2017	XAL	4	6	21	1345
Decembre	2017	GRE	1	6	12	1346
Decembre	2017	GRE	2	6	15	1347
Decembre	2017	LLE	1	6	10	1348
Decembre	2017	LLE	2	6	15	1349
Decembre	2017	LLE	3	6	14	1350
Decembre	2017	LLE	4	6	28	1351
Decembre	2017	LLE	5	6	1	1352
Decembre	2017	XAL	1	6	10	1353
Decembre	2017	XAL	2	6	21	1354
Decembre	2017	XAL	3	6	21	1355
Decembre	2017	XAL	4	6	20	1356
\.


--
-- TOC entry 2996 (class 0 OID 0)
-- Dependencies: 198
-- Name: consumoxiflow_ampolla_id_seq; Type: SEQUENCE SET; Schema: pspv_schema; Owner: rom_pspv
--

SELECT pg_catalog.setval('pspv_schema.consumoxiflow_ampolla_id_seq', 1356, true);


-- Completed on 2020-01-30 11:25:16 CET

--
-- PostgreSQL database dump complete
--

