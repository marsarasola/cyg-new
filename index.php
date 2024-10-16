<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/styles/index.css?v=2.0">
    <link rel="shortcut icon" href="./public/assets/C&G COLOR-01.png" type="image/x-icon">
    <title>C&G</title>
</head>

<body>

    <?php include './app/header.php'; ?>
    
    <div class="carousel" id="mainCarousel">
        <div class="carousel-inner" id="inicio">
            <div class="carousel-item active">
                <img src="./public/assets/carrousel1.jpg" alt="img1">
            </div>
            <div class="carousel-item">
                <img src="./public/assets/carrousel2.jpg" alt="img2">
            </div>
            <div class="carousel-item">
                <img src="./public/assets/3.jpg" alt="img3">
            </div>
        </div>
        <button class="carousel-control prev" type="button">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control next" type="button">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container" id="empresa">
        <h1>NUESTRA EMPRESA</h1>
        <p>Profesionalismo, creatividad, rapidez y eficacia definen el ambiente de apoyo constante de nuestra empresa, con servicios integrales en Ingeniería para Industrias. Dentro de sus servicios, la empresa ha definido los más altos estándares de calidad, contando e instruyendo al personal con capacitaciones requeridas para el cumplimiento de las normas exigidas.</p>
        <div class="vision-container">
            <div class="vision-item">
                <img src="./public/assets/empresa.png" alt="Empresa">
                <h2>EMPRESA</h2>
                <p>Somos una empresa recientemente formada con profesionales de más de 10 años de experiencia en el área de Ingeniería y Proyectos. Contamos con un equipo multidisciplinario que trabaja responsablemente con el fin de brindar un servicio de calidad en Consultoría y Asesoramiento para sus proyectos.</p>
            </div>
            <div class="vision-item">
                <img src="./public/assets/vision.png" alt="Nuestra Visión">
                <h2>NUESTRA VISIÓN</h2>
                <p>Ser una empresa que agregue valor a los proyectos, a través de Servicios de Ingeniería, desarrollados a la medida de las necesidades de sus clientes.</p>
            </div>
            <div class="vision-item">
                <img src="./public/assets/mision.png" alt="Nuestra Misión">
                <h2>NUESTRA MISIÓN</h2>
                <p>Ofrecer soluciones en las diferentes etapas de los proyectos, con un equipo multidisciplinario, satisfaciendo completamente los requerimientos, buscando y desarrollando soluciones creativas e innovadoras, respetando el medio ambiente y haciendo un uso responsable de los recursos para un desarrollo sostenido de los negocios y del planeta.</p>
            </div>
        </div>
    </div>

    <div class="container" id="quienes-somos">
        <h1>QUIÉNES SOMOS</h1>
        <div class="somos-container">
            <div class="somos-item">
                <img src="./public/assets/iconMujer.png" alt="Ingeniera Mirta Gimenez">
                <h2>ING. MIRTA GIMENEZ</h2>
                <p>Ingeniera Mecánica con más de 10 años de experiencia en empresas Multinacionales del rubro alimenticio. Posgrado en Gerenciamiento de Proyectos y Seguridad e Higiene. Ha realizado proyectos Civiles y Electromecánicos, desarrollo de Máster Plan para nuevas plantas productivas y adecuación de plantas existentes para cumplimiento de normas locales e internacionales, desarrollo e instalación de líneas de producción para casos de éxito en Snacks Salados, Cookies y Papas congeladas. Experiencia en diversas plantas de Latinoamérica gerenciando Proyectos con Herramientas de Project Management.</p>
            </div>
            <div class="somos-item">
                <img src="./public/assets/iconHombre.png" alt="Ingeniero Pablo Cattaneo">
                <h2>ING. PABLO CATTANEO</h2>
                <p>Ingeniero Mecánico con más de 15 años de experiencia en empresas de Ingeniería y Construcciones. Especialista y Docente en Gerenciamientos de Proyectos Industriales. ASME Membercertified en Cálculo de recipientes a presión. Especialista en Diseño y Cálculo por Elementos Finitos FEA. Ha realizado proyectos para la industria Naval, Petroquímica, Gas, Mineras, y de la Alimentación. Siete años de experiencia en gerenciamiento de proyectos de instalación de nuevas líneas de producción en empresas Multinacionales altamente reconocidas.</p>
            </div>
        </div>
    </div>

    <div class="container" id="servicios">
        <h1>NUESTROS SERVICIOS</h1>
        <p>Servicios que pueden ser brindados por diferentes profesionales, para agregar valor a sus proyectos, apoyando el desarrollo de Industrias y/o profesionales. Los Servicios pueden brindarse en cualquier etapa de su proyecto y los mismos incluyen: Asesoramiento y Consultoría, para entender factibilidad y seleccionar tecnologías, Gestión de Proyectos, Planificación y Control para asegurar el alcance de los objetivos, Confección de Ingenierías, Básicas y de Detalle para una correcta ejecución de los proyectos, así como Dirección y Coordinación de Obras.</p>
        <div class="service-container">
            <div class="service-card">
                <img src="./public/assets/imgConsultoria.jpg" alt="Consultoría">
                <div class="service-overlay">
                    <p>Realizamos asesoramiento y consultoría, para formular sus proyectos, analizar factibilidad y conceptos básicos.</p>
                </div>
            </div>
            <div class="service-card">
                <img src="./public/assets/gerenciamiento.jpg" alt="Gerenciamiento">
                <div class="service-overlay">
                    <p>Realizamos el Gerenciamiento de su Proyecto, la Administración de Recursos, la Planificación y Control.</p>
                </div>
            </div>
            <div class="service-card">
                <img src="./public/assets/ejecucion.jpg" alt="Ejecución">
                <div class="service-overlay">
                    <p>Lideramos la Implementación de sus Proyectos, Confección de Ingenierías, así como Dirección y Coordinación de Obras.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="experiencia">
        <h1>PROYECTOS</h1>
        <div class="experience-container">

            <?php
            include('./app/admin/config.php'); // Incluir la configuración de la base de datos

            // Obtener los trabajos de la base de datos
            $sql = "SELECT * FROM trabajos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imgArray = explode(',', $row['img']); // Obtener las imágenes y separarlas
                    $mainImage = htmlspecialchars(trim($imgArray[0])); // Tomar la primera imagen como principal
                    $title = htmlspecialchars($row['titulo']);
                    $description = htmlspecialchars($row['exp']);
                    $imagesJson = json_encode($imgArray); // Convertir las imágenes a JSON
            ?>

                    <div class="experience-card">
                        <?php
                        // No necesitamos escapar con addslashes si usamos json_encode adecuadamente
                        $encodedTitle = json_encode($title);
                        $encodedDescription = json_encode($description);
                        ?>

                        <img src="./public/assets/<?php echo $mainImage; ?>"
                            alt="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>"
                            data-id="<?php echo $row["id"]; ?>"
                            data-title="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>"
                            data-description="<?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>"
                            data-images='<?php echo $imagesJson; ?>'
                            onclick="toggleDetailsFromData(this)">


                        <h2><?php echo $title; ?></h2>
                        <div id="details-<?php echo $row['id']; ?>" class="details" style="display: none;">
                            <p><?php echo $description; ?></p>
                            <div class="images">
                                <?php foreach ($imgArray as $image): ?>
                                    <img src="./public/assets/<?php echo htmlspecialchars(trim($image)); ?>" alt="Imagen de <?php echo $title; ?>">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<p>No hay proyectos disponibles.</p>";
            }
            ?>

        </div>
    </div>


    <!-- Modal para mostrar detalles -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">×</button>
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
            </div>
            <div class="modal-body">
                <p id="modalDescription"></p>
                <div id="modalImages" class="grid-container">
                    <!-- Las imágenes se insertarán aquí dinámicamente -->
                </div>
            </div>
        </div>
    </div>



    <?php include './app/footer.php'; ?>

    <script src="./public/js/index.js?v=2.0" defer></script>
</body>

</html>