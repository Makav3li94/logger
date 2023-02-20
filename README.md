## Logger

Logger store logs to database for different purposes.
<br>
Process is done with chunk and LazyCollection for big data.
<br>
It doesn't store duplicate logs

## First Clone Logger

first clone the project
<br>
<code>composer update</code>
<br>
Set "CHUNK_SIZE" in env based on logs file size,
<br>
for example for 100,000 Set it to 10,000

## Api

you can fetch log counts with
<br>
http://127.0.0.1:8000/api/logs/count
<br>
you can apply filters such as
<br>
<code>
[
'serviceNames' => 'test',
'statusCode' => 201,
'startDate' => '2022-09-17 10:21:53',
'endDate' => '2022-10-17 10:21:53',
]
</code>

## Project Description

<p>
   1- this project was done in less than 5 hours
<br>
<br>
    2- we should separate log inputs to different interface for I/O in solid
but that would take a little time
    <br>
    <br>
3-we must extract file reading functionality from console command to interface or trait,but because of chunk and being able to process big data,
i skipped  that part.
</p>
