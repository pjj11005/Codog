from cryptography import x509
from cryptography.hazmat.backends import default_backend
import firebase_admin
from firebase_admin import credentials
from firebase_admin import db
import traceback
import json
import random

#database url입력 (변경가능)
db_url = 'https://firm-affinity-384813-default-rtdb.firebaseio.com/'
print(f"db_url: {db_url}")

# 서비스 계정의 비공개 키 파일이름(변경가능)
cred = credentials.Certificate("firm-affinity-384813-firebase-adminsdk-ltf11-2aba40255c.json")
# https://firm-affinity-384813-default-rtdb.firebaseio.com/
print(f"cred: {cred}")

default_app = firebase_admin.initialize_app(cred, {'databaseURL': db_url})
print(f"default_app: {default_app}")

# 새로운 Firebase 앱을 초기화하는 경우
new_app = firebase_admin.initialize_app(cred, {'databaseURL': db_url}, name='new-app')
print(f"new_app: {new_app}")

# 사용할 Firebase 앱을 지정하여 데이터베이스 참조 생성
ref = db.reference(app=new_app)
print(f"ref: {ref}")


# ====================================================================================================
# db 에 강아지 정보 입력
# 입력시 이름 저장하게 하는코드 추가해야함

# ref = db.reference('dogs') # 'dogs'라는 이름의 데이터베이스 레퍼런스 생성
# print(f"ref: {ref}")
#
# dog_ref = ref.push() # 새로운 고유 식별자를 생성하여 레퍼런스 가져오기
# print(f"dog_ref: {dog_ref}")
#
# dog_ref.set({#예시
#     'vaccinated': True, # 백신 접종 유무
#     'size': 'small', # 강아지 크기
#     'place': 'Gangnam', # 서울 지역구
#     'breed': 'Poodle', # 품종
#     'neutered': False, # 중성화 여부
#     'activity_level': 'high', # 활발한 정도
#     'gender': 'female' # 성별
# })
# print('데이터 저장 완료')
#
#
# # 데이터 저장
# ref = db.reference('dogs') # 'dogs'라는 이름의 데이터베이스 레퍼런스 생성
#
# # 랜덤으로 64개의 데이터 생성
# districts = ['Gangnam', 'Gangdong', 'Gangbuk', 'Gangseo', 'Gwanak', 'Gwangjin', 'Guro', 'Geumcheon', 'Nowon', 'Dobong', 'Dongdaemun', 'Dongjak', 'Mapo', 'Seodaemun', 'Seocho', 'Seongdong', 'Seongbuk', 'Songpa', 'Yangcheon', 'Yeongdeungpo', 'Yongsan', 'Eunpyeong', 'Jongno', 'Jung', 'Jungnang']
# sizes = ['small', 'medium', 'large']
# breeds = ['Poodle', 'Labrador', 'Golden Retriever', 'Chihuahua', 'Bulldog', 'Shih Tzu', 'Yorkshire Terrier', 'Pomeranian', 'Maltese', 'Dachshund', 'Beagle', 'Bichon Frise', 'Shetland Sheepdog']
# activity_levels = ['low', 'medium', 'high']
# genders = ['male', 'female']
#
# dogs = []
# for i in range(64):
#     dog = {
#         'vaccinated': bool(random.getrandbits(1)),
#         'size': random.choice(sizes),
#         'place': random.choice(districts),
#         'breed': random.choice(breeds),
#         'neutered': bool(random.getrandbits(1)),
#         'activity_level': random.choice(activity_levels),
#         'gender': random.choice(genders)
#     }
#     dogs.append(dog)
#
#     print(f"len(dogs): {len(dogs)}")
#
# # -----------------------------------------------------------------------------------------------
# # 생성된 64개의 데이터를 DB에 저장
# for dog in dogs:
#     # 새로운 고유 식별자를 생성하여 레퍼런스 가져오기
#     dog_ref = ref.push()
#     dog_ref.set(dog)
#
# print('데이터 저장 완료')


# ====================================================================================================
# db에서 64개의 데이터 랜덤추출 후 이상형 월드컵 진행

def random_worldcup(SIZE, PLACE, BREADS):
    try:
        # 데이터베이스 레퍼런스 가져오기
        # ref = db.reference('dogs')
        ref = db.reference('posts')

        # 'place'가 'Gangnam'인 항목 필터링
        # gangnam_posts = ref.order_by_child('place').equal_to('강남구').get()
        #
        # print(f"gangnam_posts: {gangnam_posts}")

        # 'size'가 'small'인 항목 추가 필터링
        # small_gangnam_posts = {k: v for k, v in gangnam_posts.items() if v.get('size') == 'small'}
        # print(f"small_gangnam_posts: {small_gangnam_posts}")




        # 전체 데이터 가져오기
        snapshot = ref.order_by_key().get()
        data_list = list(snapshot.values())

        # 전체 데이터에서 무작위로 64개 추출하기
        dog_list = []
        dogs = ref.get()
        for key, value in dogs.items():
            # if value.get('size') == SIZE and value.get('place') == PLACE or value.get('breed') in BREADS:
            # if value.get('size') == SIZE and value.get('place') == PLACE and value.get('breed') in BREADS:
            #     dog_list.append(key)
            dog_list.append(key)

        print(f"dog_list: {dog_list}")
        print(f"len(dog_list): {len(dog_list)}")
        t_dog_list = len(dog_list)
        # selected_dogs = random.sample(dog_list, k=64)
        # selected_dogs = random.sample(dog_list, k=t_dog_list)

        if t_dog_list > 32:
            t_dog_list = 32
            print("force t_dog_list to 32")

        selected_dogs = random.sample(dog_list, k=t_dog_list)

        print(f"selected_dogs: {selected_dogs}")

        # 이상형 월드컵 진행
        winners = []
        round = 1
        while len(selected_dogs) > 1:
            print(f'==== ROUND {round} ====')
            next_round = []

            print(f"len(selected_dogs): {len(selected_dogs)}")
            print(f"selected_dogs: {selected_dogs}")

            for i in range(0, len(selected_dogs), 2):
                try:
                    dog1 = ref.child(selected_dogs[i]).get()
                    dog2 = ref.child(selected_dogs[i + 1]).get()

                except IndexError:
                    print(f"IndexError: {IndexError}")
                    print(f"selected_dogs[i]: {selected_dogs[i]}")
                    dog2 = ref.child(selected_dogs[i]).get()

                print(f'{dog1["breed"]} VS {dog2["breed"]}')
                if random.choice([True, False]):
                    print(f'{dog1["breed"]} Wins!\n')
                    next_round.append(selected_dogs[i])
                    winners.append(selected_dogs[i])
                else:
                    print(f'{dog2["breed"]} Wins!\n')

                    try:
                        next_round.append(selected_dogs[i + 1])
                        winners.append(selected_dogs[i + 1])

                    except IndexError:
                        print(f"IndexError: {IndexError}")

            selected_dogs = next_round
            round += 1

        # 이상형 월드컵 우승자 출력
        # print(f'==== WINNER : {ref.child(winners[0]).child("breed").get()} ====')
        # print(ref.child(winners[0]).get())

        # 이상형 월드컵 우승자 정보 가져오기
        winner_id = winners[0]
        winner_ref = ref.child(winner_id)
        winner = winner_ref.get()

        # 데이터베이스에 우승자 정보 저장하기
        db.reference('winners').child(winner_id).set(winner)

        # ====================================================================================================
        # 최종 선정된 것과 유사한것 3개 추천

        from sklearn.metrics.pairwise import cosine_similarity

        # 우승한 강아지 정보 가져오기
        # winner = db.reference(f'dogs/{winners[0]}').get()
        winner = db.reference(f'posts/{winners[0]}').get()
        winners_id = winners[0]

        # 지역이 같은 강아지 정보 가져오기
        dogs_in_district = []
        for dog_id, dog in dogs.items():
            # print("=====================================")
            # print(f"dog_id: {dog_id}")
            # print(f"dog: {dog}")

            # print(f"winner: {winner}")

            if dog['place'] == winner['place']:
                dogs_in_district.append(dog)
                # print(f"dog: {dog}")

        # 컨텐츠 기반 필터링에 사용할 특성 선택
        # features = ['vaccinated', 'size', 'breed', 'neutered', 'activity_level', 'gender']
        features = ['size', 'breed', 'neutered', 'lively', 'sex']

        # 특성 데이터 추출 및 가공
        X = []
        for dog in dogs_in_district:

            feature_vector = []
            for feature in features:
                # if feature in ['vaccinated', 'neutered']:
                if feature in ['neutered']:
                    # feature_vector.append(int(dog[feature]))
                    pass
                elif feature == 'size':
                    size = dog['size']
                    if size == 'small':
                        feature_vector += [1, 0, 0, 0]
                    elif size == 'medium':
                        feature_vector += [0, 1, 0, 0]
                    elif size == 'large':
                        feature_vector += [0, 0, 1, 0]
                    else:
                        feature_vector += [0, 0, 0, 1]
                # elif feature == 'activity_level':
                elif feature == 'lively':
                    if dog[feature] == 'low':
                        feature_vector += [1, 0, 0]
                    elif dog[feature] == 'medium':
                        feature_vector += [0, 1, 0]
                    else:
                        feature_vector += [0, 0, 1]
                # elif feature == 'gender':
                elif feature == 'sex':
                    if dog[feature] == 'male':
                        feature_vector += [1, 0]
                    else:
                        feature_vector += [0, 1]
                else:  # breed
                    # winner와 동일한 품종인 경우 1, 아닌 경우 0으로 feature_vector에 추가
                    if dog[feature] == winner[feature]:
                        feature_vector.append(1)
                    else:
                        feature_vector.append(0)
            X.append(feature_vector)

        # 코사인 유사도 계산
        cosine_sim = cosine_similarity(X)

        # 유사도가 높은 강아지 3개 선택
        sim_indices = cosine_sim[0].argsort()[:-4:-1]

        recommendations = [dogs_in_district[i] for i in sim_indices]

        res_list = []

        # 결과 출력
        for dog in recommendations:
            print(f"추천 강아지 - 지역: {dog['place']}, 품종: {dog['breed']}, 크기: {dog['size']}, 중성화 여부: {dog['neutered']}, 활발한 정도: {dog['lively']}, 성별: {dog['sex']}")

            # print to json
            res_list.append(dog)

        # res_list to json
        # res_list =

        return res_list

    except Exception as e:
        print(f"Exception: {e}")
        print(traceback.format_exc())
        return []



# random_worldcup()