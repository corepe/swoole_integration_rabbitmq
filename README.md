# swoole_integration_rabbitmq



```
#ab -c 100  -n 10000 -k  http://localhost:9501/?

-- output: 
This is ApacheBench, Version 2.3 <$Revision: 1706008 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking localhost (be patient)
Completed 1000 requests
Completed 2000 requests
Completed 3000 requests
Completed 4000 requests
Completed 5000 requests
Completed 6000 requests
Completed 7000 requests
Completed 8000 requests
Completed 9000 requests
Completed 10000 requests
Finished 10000 requests


Server Software:        swoole-http-server
Server Hostname:        localhost
Server Port:            9501

Document Path:          /?status=23
Document Length:        21 bytes

Concurrency Level:      100
Time taken for tests:   0.631 seconds
Complete requests:      10000
Failed requests:        0
Keep-Alive requests:    10000
Total transferred:      1740000 bytes
HTML transferred:       210000 bytes
Requests per second:    15840.68 [#/sec] (mean)
Time per request:       6.313 [ms] (mean)
Time per request:       0.063 [ms] (mean, across all concurrent requests)
Transfer rate:          2691.68 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.3      0       4
Processing:     1    6   3.8      5      68
Waiting:        1    6   3.7      5      68
Total:          1    6   3.8      5      68

Percentage of the requests served within a certain time (ms)
  50%      5
  66%      6
  75%      8
  80%      8
  90%     10
  95%     13
  98%     15
  99%     16
 100%     68 (longest request)

```
 
