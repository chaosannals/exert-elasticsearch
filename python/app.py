from elasticsearch import Elasticsearch

es = Elasticsearch()
r = es.indices.create(index='my-index', ignore=400)
print(r)
