<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Notulen Rapat</title>
     <style>
          body {
               font-family: Arial, sans-serif;
          }

          .header {
               text-align: center;
          }

          .footer {
               position: fixed;
               bottom: 0;
               text-align: center;
               width: 100%;
          }

          .content {
               margin-top: 100px;
          }

          table {
               width: 100%;
               border-collapse: collapse;
          }

          th,
          td {
               border: 1px solid black;
               padding: 8px;
               text-align: left;
          }
     </style>
</head>

<body>
     <div class="header">
          <img src="{{ public_path('path/to/logo.png') }}" alt="Logo" style="width: 100px;">
          <h1>KEMENTERIAN PENDIDIKAN KEBUDAYAAN RISET DAN TEKNOLOGI</h1>
          <h2>POLITEKNIK NEGERI BALI</h2>
          <h3>JURUSAN TEKNOLOGI INFORMASI</h3>
          <p>Jalan Kampus Bukit Jimbaran Kuta Selatan Kabupaten Badung Bali – 80364</p>
          <p>Telp. (0361) 701981 (hunting) Fax. 701128</p>
          <p>Laman: jti.pnb.ac.id Email: ti@pnb.ac.id</p>
     </div>
     <div class="content">
          <h2>NOTULEN RAPAT KOORDINASI SURVEY PASAR</h2>
          <p><strong>Dasar:</strong> {{ $basis }}</p>
          <p><strong>Pimpinan Rapat:</strong> {{ $chairperson }}</p>
          <p><strong>Agenda:</strong> {{ $activity }}</p>
          <p><strong>Notulis:</strong> {{ $minute_taker }}</p>
          <p><strong>Hari/Tanggal:</strong> {{ $date }}</p>
          <p><strong>Pukul:</strong> {{ $start_time }}</p>
          <p><strong>Tempat:</strong> {{ $location }}</p>
          <p><strong>Metode:</strong> {{ $method }}</p>
          <p><strong>Hasil:</strong> {{ $outcome }} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quasi cumque eligendi aliquam ratione ipsum,
          voluptatum officiis aut eaque iusto minima ea, excepturi libero aperiam repellendus id incidunt, autem facilis natus
          explicabo? Doloribus, at? Porro sequi quaerat dolores. Nisi quaerat pariatur dolorum odit, a officiis voluptatum
          voluptatem in. Nobis cupiditate iste magni laborum velit maxime fugit fuga cumque dolores. A alias eveniet odit aut
          incidunt placeat magnam mollitia delectus sed ipsa. Adipisci accusantium voluptas provident, deleniti vitae mollitia
          animi labore corrupti, tempora ipsa voluptatem, maiores non? Soluta, dolor magni, architecto nam harum veniam odio
          ratione nesciunt culpa accusamus ab tempora quia inventore qui velit, quaerat alias praesentium vero eaque quos enim?
          Delectus quod sed mollitia omnis praesentium, laboriosam adipisci necessitatibus eos nostrum minus commodi nobis
          corrupti doloribus eveniet cumque. Deserunt fuga tenetur velit eius. Numquam temporibus iste error eaque sunt.
          Perspiciatis sequi earum voluptatibus sapiente atque repellat nulla vel quod nemo temporibus deserunt aliquam asperiores
          quibusdam, laudantium enim? Quos facere ipsa voluptatum voluptatem. Voluptates praesentium officiis alias, soluta
          placeat fugit voluptas labore rem illum tempora quos. Vitae itaque, neque at officiis labore, accusamus suscipit
          cupiditate necessitatibus et facere distinctio sint veniam. Enim suscipit provident accusamus atque non alias! Animi hic
          atque veritatis! Culpa eos quisquam sapiente pariatur repellat ipsam fuga deleniti saepe ex ipsum? Expedita
          reprehenderit voluptates, error, distinctio earum deleniti eum minus odio consequatur repudiandae excepturi nostrum modi
          molestias praesentium amet? Quas minus maiores, doloremque provident rerum debitis porro sunt officiis placeat illum cum
          optio! Explicabo ex assumenda animi quam. Ipsum, veritatis. Quo labore corrupti odio, voluptas quaerat vel obcaecati
          distinctio voluptatum eaque, laudantium beatae. Recusandae eos dolores esse quod explicabo dolor amet ipsa illum.
          Inventore quia, reiciendis consequatur accusantium praesentium nostrum, at adipisci delectus iure nesciunt cumque
          numquam, rem ullam eius fuga reprehenderit earum? Repellat totam esse numquam!</p>
     </div>
     <div class="footer">
          <p>Bukit Jimbaran, ..... Juni 2024</p>
          <p>Mengetahui</p>
          <p>Ketua Jurusan Teknologi Informasi</p>
          <p>Prof. Dr. I Nym. Gede Arya Astawa S.T. M.Kom.</p>
          <p>NIP. 196902121995121001</p>
          <br>
          <p>Notulis</p>
          <p>{{ $minute_taker }}</p>
          <p>NIP. xxxxxx</p>
     </div>
</body>

</html>
