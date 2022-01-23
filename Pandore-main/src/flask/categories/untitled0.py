# -*- coding: utf-8 -*-
"""
Created on Mon Jan 17 11:23:26 2022

@author: simon.ak
"""

import pandas as pd
from datetime import datetime
from numpy.random import randint

# with open('code_naf.txt', 'r') as f:
#     text = f.readlines()
    
# for i,v in enumerate(text):
#     with open('result_code_naf.txt', 'a') as f:
#         f.write(f'"{v[:5]}":{i},')
        

ceo = {
       0: {
           'email': 'benali.ahmed@gmail.com',
           'siret': ['12345678901231', '12345678901232', '12345678901234']
           },
       1: {
           'email': 'lennon.bob@gmail.com',
           'siret': ['35282361100053']
           },
       2: {
           'email': 'parks.rosa@gmail.com',
           'siret': ['12345678901230', '12345678901233']
           }
       }

df = pd.concat([ pd.read_csv('../data2/2020.csv', sep=","), \
    pd.read_csv('../data2/2019.csv', sep=","), \
        pd.read_csv('../data2/2018.csv', sep=",") ])
    
today_dt = datetime.now().strftime("%Y-%m-%d %H:%M:%S")


with open('sql_command.txt','w') as f:
    f.write("INSERT INTO audit(dateRealization,userEmail,siret,detteNette,chiffreAffaire,resultatNet,fondsPropres,bfr,variationBFR,fr,ebe,capitalSocial,coutDette,detteCT,detteLT,tresorerie,caf,bilanTotal,ratioGearing,rentabiliteExploitation,rentabiliteGlobale,ratioEquity,ratioLevier,icr,resultAudit) VALUES ")
    
    
for i in range(len(df)):
    detteNette = df.iloc[i]['DetteNette']
    chiffreAffaire = df.iloc[i]['ChiffreAffaire']
    resultatNet = df.iloc[i]['ResultatNet']
    fondsPropres = df.iloc[i]['FondsPropres']
    bfr = df.iloc[i]['BFR']
    variationBFR = -1
    fr = df.iloc[i]['FR']
    ebe = df.iloc[i]['EBE']
    capitalSocial = df.iloc[i]['CapitalSocial']
    coutDette = df.iloc[i]['CoûtDette']
    detteCT = -1
    detteLT = -1
    tresorerie = df.iloc[i]['Tresorerie']
    caf = df.iloc[i]['CAF']
    bilanTotal = df.iloc[i]['BilanTotal']
    ratioGearing = df.iloc[i]['RatioGearing']
    rentabiliteExploitation = df.iloc[i]['RentabiliteExploitation']
    rentabiliteGlobale = df.iloc[i]['RentabiliteGlobale']
    ratioEquity = df.iloc[i]['RatioEquity']
    ratioLevier = df.iloc[i]['RatioLevier']
    icr = df.iloc[i]['ICR']
    resultAudit = df.iloc[i]['Note3C']
    
    r = randint(0,len(ceo))
    email = ceo[r]['email']
    siret = ceo[r]['siret'][randint(0,len(ceo[r]['siret']))]
    
    with open('sql_command.txt','a') as f:
        f.write(f"('{today_dt}','{email}','{siret}',{detteNette},{chiffreAffaire},{resultatNet},{fondsPropres},{bfr},{variationBFR},{fr},{ebe},{capitalSocial},{coutDette},{detteCT},{detteLT},{tresorerie},{caf},{bilanTotal},{ratioGearing},{rentabiliteExploitation},{rentabiliteGlobale},{ratioEquity},{ratioLevier}, {icr},{resultAudit}), ")