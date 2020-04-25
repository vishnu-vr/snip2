import flask
from flask import Flask,request,render_template,redirect,url_for,make_response
from flask import session
import datetime
import os
import requests
import jsonify,json
from scrape import Attendance
from flask_cors import CORS

app = Flask(__name__)
app.config["DEBUG"] = True
app.secret_key =os.urandom(24)
#enabling CORS support
CORS(app)

@app.route('/')
def index():
    # return jsonify(Attendance())
    print("hello")
    return "Hi World"

@app.route('/attendance', methods=['GET','POST'])
def attendance():
    if (request.method == 'GET'):
        response = flask.jsonify({'some': 'data'})
        response.headers.add('Access-Control-Allow-Origin', '*')
        return response,200
        #return json.dumps({'success':True}), 200, {'ContentType':'application/json'} 
    if ( request.method == 'POST'):
        #return [{"testing works":True}]
        username=None
        password=None
        if request.is_json:
            data = request.get_json(force=True)
            if 'username' in data:
                username = data['username']
            if 'password' in data:
                password = data['password']
        data, name_of_user = Attendance(username,password)
        #print("reached here!")##remove this
        if(data == None):
            return make_response(jsonify("Incorrect Password"), 404)
        payload = []
        try:
            p=1
            print(data)
            for i in data:
                v_data={}
                ##name of the user
                v_data['name_of_user'] = name_of_user
                v_data['subject'] = i[0]
                v_data['total_class'] = i[1]
                v_data['atten_class'] = i[4]
                v_data['percentage'] = i[5]
                #v_data['c_snip'] = 0   //removed it because its not used
                '''
                if(float(i[5])>76):
                    snip = (float(i[4])-(float(i[1])*.75))/.75
                    a = isinstance(snip, float)
                    if(a ==True):
                        snip=(int(snip)+1)
                    if(float(i[4])/(float((i[1]))+snip)< .75):
                        snip=(int(snip)-1)
                    # print('You can snip ',i[0],'for',snip)
                    v_data['snip'] = snip
                elif(i[5]==76 or i[5] == 75):
                    # print('You can Snip',i[0],'0 hours')
                    v_data['snip'] = 0
                else:
                    snip = ((.75*float(i[1]))-float(i[4]))/.25
                    a = isinstance(snip, float)
                    if(a ==True):
                        snip=(int(snip)+1)
                        # print('You need to attend',i[0],'for',snip)
                        v_data['snip'] = snip*-1
                '''
                payload.append(v_data)
                p = p+1   
                    
        except Exception as e:
            print(e)
        payload = flask.jsonify(payload)
        payload.headers.add('Access-Control-Allow-Origin', '*')
        return payload,200

if __name__ == '__main__':
   #app.run("localhost",1234,debug = True)
   app.run(debug = True)