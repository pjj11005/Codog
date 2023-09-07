from flask import Flask, request, jsonify
from flask_cors import CORS, cross_origin
from main import *

app = Flask(__name__)
CORS(app)  # This will enable CORS for all routes
app.config['CORS_HEADERS'] = 'Content-Type'

@app.route('/')
@cross_origin()
def hello_world():  # put application's code here
    return 'Hello World!'


@app.route('/run', methods=['POST'])
@cross_origin()  # This will enable CORS for this route
def run():
    if not request.is_json:
        return jsonify({"msg": "Missing JSON in request"}), 400

    print(f"request: {request}")
    data = request.get_json()

    size = data.get('size')
    place = data.get('place')
    breeds = data.get('breeds')

    # running code
    print(f"size: {size}")
    print(f"place: {place}")
    print(f"breeds: {breeds}")

    # breeds : a, b, c, d
    # string -> list
    breeds = breeds.split(',')
    print(f"breeds: {breeds}")

    res_json = random_worldcup(SIZE=size, PLACE=place, BREADS=breeds)

    res_json = {"data": res_json}

    print(f"res_json: {res_json}")
    return res_json, 200


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8888, debug=True)


