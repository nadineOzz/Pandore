# -*- coding: utf-8 -*-
"""
Created on Mon Jan 10 16:33:06 2022

@author: simon.ak
"""

# --------------------------------------------------------------------------- #
# ------------------------- Librairies Importation -------------------------- #
# --------------------------------------------------------------------------- #

import pickle
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn import metrics

from sklearn.tree import DecisionTreeClassifier

# --------------------------------------------------------------------------- #
# ---------------------------- Create Categories ---------------------------- #
# --------------------------------------------------------------------------- #

def cat_effectif(form_eff):
    if form_eff == "0 salarié": effectif = 0
    elif form_eff == "Entre 1 et 2 salariés": effectif = 1
    elif form_eff == "Entre 3 et 5 salariés": effectif = 2
    elif form_eff == "Entre 6 et 9 salariés": effectif = 3
    elif form_eff == "Entre 10 et 19 salariés": effectif = 4
    elif form_eff == "Entre 20 et 49 salariés": effectif = 5
    elif form_eff == "Entre 50 et 99 salariés": effectif = 6
    elif form_eff == "Entre 250 et 499 salariés": effectif = 7
    elif form_eff == "Entre 500 et 999 salariés": effectif = 8
    elif form_eff == "Entre 1 000 et 1 999 salariés": effectif = 9
    elif form_eff == "Entre 2 000 et 4 999 salariés": effectif = 10
    elif form_eff == "Entre 5 000 et 9 999 salariés": effectif = 11
    elif form_eff == "Plus de 10 000 salariés": effectif = 12
    else: effectif = -1
    return effectif

def cat_formeJuridique(form_fj):
    if form_fj == "EURL": forme_juridique = 0
    elif form_fj == "Groupement foncier agricole": forme_juridique = 1
    elif form_fj == "SA": forme_juridique = 2
    elif form_fj == "SARL": forme_juridique = 3
    elif form_fj == "SAS": forme_juridique = 4
    elif form_fj == "SASU": forme_juridique = 5
    elif form_fj == "Société coopérative agricole": forme_juridique = 6
    else: forme_juridique = -1
    return forme_juridique

naf = {"0111Z":0,"0112Z":1,"0113Z":2,"0114Z":3,"0115Z":4,"0116Z":5,"0119Z":6,"0121Z":7,"0122Z":8,"0123Z":9,"0124Z":10,"0125Z":11,"0126Z":12,"0127Z":13,"0128Z":14,"0129Z":15,"0130Z":16,"0141Z":17,"0142Z":18,"0143Z":19,"0144Z":20,"0145Z":21,"0146Z":22,"0147Z":23,"0149Z":24,"0150Z":25,"0161Z":26,"0162Z":27,"0163Z":28,"0164Z":29,"0170Z":30,"0210Z":31,"0220Z":32,"0230Z":33,"0240Z":34,"0311Z":35,"0312Z":36,"0321Z":37,"0322Z":38,"0510Z":39,"0520Z":40,"0610Z":41,"0620Z":42,"0710Z":43,"0721Z":44,"0729Z":45,"0811Z":46,"0812Z":47,"0891Z":48,"0892Z":49,"0893Z":50,"0899Z":51,"0910Z":52,"0990Z":53,"1011Z":54,"1012Z":55,"1013A":56,"1013B":57,"1020Z":58,"1031Z":59,"1032Z":60,"1039A":61,"1039B":62,"1041B":63,"1042Z":64,"1051A":65,"1051B":66,"1051C":67,"1051D":68,"1052Z":69,"1061A":70,"1061B":71,"1062Z":72,"1071A":73,"1071B":74,"1071C":75,"1071D":76,"1072Z":77,"1073Z":78,"1081Z":79,"1082Z":80,"1083Z":81,"1084Z":82,"1085Z":83,"1086Z":84,"1089Z":85,"1091Z":86,"1092Z":87,"1101Z":88,"1102A":89,"1102B":90,"1103Z":91,"1104Z":92,"1105Z":93,"1106Z":94,"1107A":95,"1107B":96,"1200Z":97,"1310Z":98,"1320Z":99,"1330Z":100,"1391Z":101,"1392Z":102,"1393Z":103,"1394Z":104,"1395Z":105,"1396Z":106,"1399Z":107,"1411Z":108,"1412Z":109,"1413Z":110,"1414Z":111,"1419Z":112,"1420Z":113,"1431Z":114,"1439Z":115,"1511Z":116,"1512Z":117,"1520Z":118,"1610A":119,"1610B":120,"1621Z":121,"1622Z":122,"1623Z":123,"1624Z":124,"1629Z":125,"1711Z":126,"1712Z":127,"1721A":128,"1721B":129,"1721C":130,"1722Z":131,"1723Z":132,"1724Z":133,"1729Z":134,"1811Z":135,"1812Z":136,"1813Z":137,"1814Z":138,"1820Z":139,"1910Z":140,"1920Z":141,"2011Z":142,"2012Z":143,"2013A":144,"2013B":145,"2014Z":146,"2015Z":147,"2016Z":148,"2017Z":149,"2020Z":150,"2030Z":151,"2041Z":152,"2042Z":153,"2051Z":154,"2052Z":155,"2053Z":156,"2059Z":157,"2060Z":158,"2110Z":159,"2120Z":160,"2211Z":161,"2219Z":162,"2221Z":163,"2222Z":164,"2223Z":165,"2229A":166,"2229B":167,"2311Z":168,"2312Z":169,"2313Z":170,"2314Z":171,"2319Z":172,"2320Z":173,"2331Z":174,"2332Z":175,"2341Z":176,"2342Z":177,"2343Z":178,"2344Z":179,"2349Z":180,"2351Z":181,"2352Z":182,"2361Z":183,"2362Z":184,"2363Z":185,"2364Z":186,"2365Z":187,"2369Z":188,"2370Z":189,"2391Z":190,"2399Z":191,"2410Z":192,"2420Z":193,"2431Z":194,"2432Z":195,"2433Z":196,"2434Z":197,"2441Z":198,"2442Z":199,"2443Z":200,"2444Z":201,"2445Z":202,"2446Z":203,"2451Z":204,"2452Z":205,"2453Z":206,"2454Z":207,"2511Z":208,"2512Z":209,"2521Z":210,"2529Z":211,"2530Z":212,"2540Z":213,"2550A":214,"2550B":215,"2561Z":216,"2562A":217,"2562B":218,"2571Z":219,"2572Z":220,"2573A":221,"2573B":222,"2591Z":223,"2592Z":224,"2593Z":225,"2594Z":226,"2599A":227,"2599B":228,"2611Z":229,"2612Z":230,"2620Z":231,"2630Z":232,"2640Z":233,"2651A":234,"2651B":235,"2652Z":236,"2660Z":237,"2670Z":238,"2680Z":239,"2711Z":240,"2712Z":241,"2720Z":242,"2731Z":243,"2732Z":244,"2733Z":245,"2740Z":246,"2751Z":247,"2752Z":248,"2790Z":249,"2811Z":250,"2812Z":251,"2813Z":252,"2814Z":253,"2815Z":254,"2821Z":255,"2822Z":256,"2823Z":257,"2824Z":258,"2825Z":259,"2829A":260,"2829B":261,"2830Z":262,"2841Z":263,"2849Z":264,"2891Z":265,"2892Z":266,"2893Z":267,"2894Z":268,"2895Z":269,"2896Z":270,"2899A":271,"2899B":272,"2910Z":273,"2920Z":274,"2931Z":275,"2932Z":276,"3011Z":277,"3012Z":278,"3020Z":279,"3030Z":280,"3040Z":281,"3091Z":282,"3092Z":283,"3099Z":284,"3101Z":285,"3102Z":286,"3103Z":287,"3109A":288,"3109B":289,"3211Z":290,"3212Z":291,"3213Z":292,"3220Z":293,"3230Z":294,"3240Z":295,"3250A":296,"3250B":297,"3291Z":298,"3299Z":299,"3311Z":300,"3312Z":301,"3313Z":302,"3314Z":303,"3315Z":304,"3316Z":305,"3317Z":306,"3319Z":307,"3320A":308,"3320B":309,"3320C":310,"3320D":311,"3511Z":312,"3512Z":313,"3513Z":314,"3514Z":315,"3521Z":316,"3522Z":317,"3523Z":318,"3530Z":319,"3600Z":320,"3700Z":321,"3811Z":322,"3812Z":323,"3821Z":324,"3822Z":325,"3831Z":326,"3832Z":327,"3900Z":328,"4110A":329,"4110B":330,"4110C":331,"4110D":332,"4120A":333,"4120B":334,"4211Z":335,"4212Z":336,"4213A":337,"4213B":338,"4221Z":339,"4222Z":340,"4291Z":341,"4299Z":342,"4311Z":343,"4312A":344,"4312B":345,"4313Z":346,"4321A":347,"4321B":348,"4322A":349,"4322B":350,"4329A":351,"4329B":352,"4331Z":353,"4332A":354,"4332B":355,"4332C":356,"4333Z":357,"4334Z":358,"4339Z":359,"4391A":360,"4391B":361,"4399A":362,"4399B":363,"4399C":364,"4399D":365,"4399E":366,"4511Z":367,"4519Z":368,"4520A":369,"4520B":370,"4531Z":371,"4532Z":372,"4540Z":373,"4611Z":374,"4612A":375,"4612B":376,"4613Z":377,"4614Z":378,"4615Z":379,"4616Z":380,"4617A":381,"4617B":382,"4618Z":383,"4619A":384,"4619B":385,"4621Z":386,"4622Z":387,"4623Z":388,"4624Z":389,"4631Z":390,"4632A":391,"4632B":392,"4632C":393,"4633Z":394,"4634Z":395,"4635Z":396,"4636Z":397,"4637Z":398,"4638A":399,"4638B":400,"4639A":401,"4639B":402,"4641Z":403,"4642Z":404,"4643Z":405,"4644Z":406,"4645Z":407,"4646Z":408,"4647Z":409,"4648Z":410,"4649Z":411,"4651Z":412,"4652Z":413,"4661Z":414,"4662Z":415,"4663Z":416,"4664Z":417,"4665Z":418,"4666Z":419,"4669A":420,"4669B":421,"4669C":422,"4671Z":423,"4672Z":424,"4673A":425,"4673B":426,"4674A":427,"4674B":428,"4675Z":429,"4676Z":430,"4677Z":431,"4690Z":432,"4711A":433,"4711B":434,"4711C":435,"4711D":436,"4711E":437,"4711F":438,"4719A":439,"4719B":440,"4721Z":441,"4722Z":442,"4723Z":443,"4724Z":444,"4725Z":445,"4726Z":446,"4729Z":447,"4730Z":448,"4741Z":449,"4742Z":450,"4743Z":451,"4751Z":452,"4752A":453,"4752B":454,"4753Z":455,"4754Z":456,"4759A":457,"4759B":458,"4761Z":459,"4762Z":460,"4763Z":461,"4764Z":462,"4765Z":463,"4771Z":464,"4772A":465,"4772B":466,"4773Z":467,"4774Z":468,"4775Z":469,"4776Z":470,"4777Z":471,"4778A":472,"4778B":473,"4778C":474,"4779Z":475,"4781Z":476,"4782Z":477,"4789Z":478,"4791A":479,"4791B":480,"4799A":481,"4799B":482,"4910Z":483,"4920Z":484,"4931Z":485,"4932Z":486,"4939A":487,"4939B":488,"4939C":489,"4941A":490,"4941B":491,"4941C":492,"4942Z":493,"4950Z":494,"5010Z":495,"5020Z":496,"5030Z":497,"5040Z":498,"5110Z":499,"5121Z":500,"5122Z":501,"5210A":502,"5210B":503,"5221Z":504,"5222Z":505,"5223Z":506,"5224A":507,"5224B":508,"5229A":509,"5229B":510,"5310Z":511,"5320Z":512,"5510Z":513,"5520Z":514,"5530Z":515,"5590Z":516,"5610A":517,"5610B":518,"5610C":519,"5621Z":520,"5629A":521,"5629B":522,"5630Z":523,"5811Z":524,"5812Z":525,"5813Z":526,"5814Z":527,"5819Z":528,"5821Z":529,"5829A":530,"5829B":531,"5829C":532,"5911A":533,"5911B":534,"5911C":535,"5912Z":536,"5913A":537,"5913B":538,"5914Z":539,"5920Z":540,"6010Z":541,"6020A":542,"6020B":543,"6110Z":544,"6120Z":545,"6130Z":546,"6190Z":547,"6201Z":548,"6202A":549,"6202B":550,"6203Z":551,"6209Z":552,"6311Z":553,"6312Z":554,"6391Z":555,"6399Z":556,"6411Z":557,"6419Z":558,"6420Z":559,"6430Z":560,"6491Z":561,"6492Z":562,"6499Z":563,"6511Z":564,"6512Z":565,"6520Z":566,"6530Z":567,"6611Z":568,"6612Z":569,"6619A":570,"6619B":571,"6621Z":572,"6622Z":573,"6629Z":574,"6630Z":575,"6810Z":576,"6820A":577,"6820B":578,"6831Z":579,"6832A":580,"6832B":581,"6910Z":582,"6920Z":583,"7010Z":584,"7021Z":585,"7022Z":586,"7111Z":587,"7112A":588,"7112B":589,"7120A":590,"7120B":591,"7211Z":592,"7219Z":593,"7220Z":594,"7311Z":595,"7312Z":596,"7320Z":597,"7410Z":598,"7420Z":599,"7430Z":600,"7490A":601,"7490B":602,"7500Z":603,"7711A":604,"7711B":605,"7712Z":606,"7721Z":607,"7722Z":608,"7729Z":609,"7731Z":610,"7732Z":611,"7733Z":612,"7734Z":613,"7735Z":614,"7739Z":615,"7740Z":616,"7810Z":617,"7820Z":618,"7830Z":619,"7911Z":620,"7912Z":621,"7990Z":622,"8010Z":623,"8020Z":624,"8030Z":625,"8110Z":626,"8121Z":627,"8122Z":628,"8129A":629,"8129B":630,"8130Z":631,"8211Z":632,"8219Z":633,"8220Z":634,"8230Z":635,"8291Z":636,"8292Z":637,"8299Z":638,"8411Z":639,"8412Z":640,"8413Z":641,"8421Z":642,"8422Z":643,"8423Z":644,"8424Z":645,"8425Z":646,"8430A":647,"8430B":648,"8430C":649,"8510Z":650,"8520Z":651,"8531Z":652,"8532Z":653,"8541Z":654,"8542Z":655,"8551Z":656,"8552Z":657,"8553Z":658,"8559A":659,"8559B":660,"8560Z":661,"8610Z":662,"8621Z":663,"8622A":664,"8622B":665,"8622C":666,"8623Z":667,"8690A":668,"8690B":669,"8690C":670,"8690D":671,"8690E":672,"8690F":673,"8710A":674,"8710B":675,"8710C":676,"8720A":677,"8720B":678,"8730A":679,"8730B":680,"8790A":681,"8790B":682,"8810A":683,"8810B":684,"8810C":685,"8891A":686,"8891B":687,"8899A":688,"8899B":689,"9001Z":690,"9002Z":691,"9003A":692,"9003B":693,"9004Z":694,"9101Z":695,"9102Z":696,"9103Z":697,"9104Z":698,"9200Z":699,"9311Z":700,"9312Z":701,"9313Z":702,"9319Z":703,"9321Z":704,"9329Z":705,"9411Z":706,"9412Z":707,"9420Z":708,"9491Z":709,"9492Z":710,"9499Z":711,"9511Z":712,"9512Z":713,"9521Z":714,"9522Z":715,"9523Z":716,"9524Z":717,"9525Z":718,"9529Z":719,"9601A":720,"9601B":721,"9602A":722,"9602B":723,"9603Z":724,"9604Z":725,"9609Z":726,"9700Z":727,"9810Z":728,"9820Z":729,"9900Z":730}

# --------------------------------------------------------------------------- #
# --------------------------- Pre-Processing Step --------------------------- #
# --------------------------------------------------------------------------- #

df = pd.concat([ pd.read_csv('data2/2020.csv', sep=","), \
    pd.read_csv('data2/2019.csv', sep=","), \
        pd.read_csv('data2/2018.csv', sep=",") ])

def df_preparation(df):
    df.drop(['Note4C'], axis=1, inplace=True)
    
    df.dropna(axis='rows', how='any', inplace=True)
    df.reset_index(drop=True,inplace=True)
    
    df.drop(['RaisonSociale', 'Siret', 'Dirigeant', \
             'DateCreation', 'Activite'], \
            axis=1, inplace=True)
              
    df['FormeJuridique'] = list(map(cat_formeJuridique, df['FormeJuridique']))
    df['Effectif'] = list(map(cat_effectif, df['Effectif']))
    df['CodeNAF'] = list(map(lambda x:naf[x], df['CodeNAF']))

df_preparation(df)


# --------------------------------------------------------------------------- #
# ------------ Classification Model using DecisionTreeClassifier ------------ #
# --------------------------------------------------------------------------- #

test_size=0.3
X_train, X_test, y_train, y_test = \
    train_test_split(df.drop('Note3C', axis=1), df['Note3C'], \
                      test_size=test_size, train_size=1-test_size, \
                          random_state=123)
            
X_train = X_train.reset_index(drop=True)
X_test = X_test.reset_index(drop=True)
y_train = y_train.reset_index(drop=True)
y_test = y_test.reset_index(drop=True)

def fit_model(X_train, y_train):
    print( f"Train Shape : {X_train.shape}, {y_train.shape}" )
    print( f"Test Shape : {X_test.shape}, {y_test.shape}" )
    
    clf = DecisionTreeClassifier(random_state=0)
    clf.fit(X_train, y_train)
    return clf

def predict_model(clf, X_test, y_test):
    y_pred = clf.predict(X_test)
    confusion_matrix = metrics.confusion_matrix(y_test, y_pred)
    print(f"Confusion Matrix...\n{confusion_matrix}")
    print(metrics.classification_report(y_test, y_pred, digits=3))
    return y_pred
   
    
clf = fit_model(X_train, y_train)
y_pred = predict_model(clf, X_test, y_test)

# --------------------------------------------------------------------------- #
# ----------------------- Save of the Model Variable ------------------------ #
# --------------------------------------------------------------------------- #

# with open('model.txt', 'wb') as f:
#     pickle.dump(clf, f)