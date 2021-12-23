# Importación de módulos
import time
import redis
from flask import Flask

# Uso de Flask
app = Flask(__name__)

# Instanciación de Redis
cache = redis.Redis(host='redis', port=6379)

# Función: realizar peticiones si el servicio de Redis no esta disponible
# Bucle básico de reintentos que nos permite realizar peticiones varias veces
# si el servicio de Redis no está disponible
def get_hit_count():
    retries = 5
    while True:
        try:
            return cache.incr('hits')
        except redis.exceptions.ConnectionError as exc:
            if retries == 0:
                raise exc
            retries -= 1
            time.sleep(0.5)


@app.route('/')
def hello():
    count = get_hit_count()
    return 'Hello World! I have been seen {} times.\n'.format(count)