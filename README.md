# swoole_integration_rabbitmq



```
#ab -n 30000 -c 500 -k http://10.132.43.14:9501/?

-- output: 
This is ApacheBench, Version 2.3 <$Revision: 655654 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking 10.132.43.14 (be patient)
Completed 3000 requests
Completed 6000 requests
Completed 9000 requests
Completed 12000 requests
Completed 15000 requests
Completed 18000 requests
Completed 21000 requests
Completed 24000 requests
Completed 27000 requests
Completed 30000 requests
Finished 30000 requests


Server Software:        swoole-http-server
Server Hostname:        10.132.43.14
Server Port:            9501

Document Path:          /?
Document Length:        21 bytes

Concurrency Level:      500
Time taken for tests:   0.659 seconds
Complete requests:      30000
Failed requests:        0
Write errors:           0
Keep-Alive requests:    30000
Total transferred:      5221044 bytes
HTML transferred:       630126 bytes
Requests per second:    45490.52 [#/sec] (mean)
Time per request:       10.991 [ms] (mean)
Time per request:       0.022 [ms] (mean, across all concurrent requests)
Transfer rate:          7731.38 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   1.0      0      11
Processing:     3   11   4.0     10      51
Waiting:        1   11   4.0     10      51
Total:          3   11   4.2     10      51

Percentage of the requests served within a certain time (ms)
  50%     10
  66%     11
  75%     12
  80%     13
  90%     15
  95%     19
  98%     23
  99%     26
 100%     51 (longest request)

```
 
