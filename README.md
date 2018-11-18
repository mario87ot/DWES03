# DWES03
Tarea 3 Desarrollo Web en Entorno Servidor

Vamos a crear una aplicación de un tablón de anuncios dónde los voluntarios de SinObsolescencia podrán publicar los bienes que desean intercambiar con otros voluntarios o vender al público en general.
Así, los anuncios podrán ser privados o públicos, por lo que dependiendo si accedemos como un usuario registrado de la ONG o como invitado veremos todos o algunos anuncios.
Dicha aplicación constará de las siguientes páginas:
    • index.php: Ofrecerá 3 opciones:
        ◦ Autentificarse mediante usuario y contraseña: Se comprobará que dicho usuario esté dado de alta en la base de datos (en la tabla anunciantes). Si el usuario y contraseña son correctos se creará una sesión y se tendrá acceso  a la página voluntario.php.

Las contraseñas están almacenadas en la base de datos usando hashing de una sola vía mediante la función crypt, por lo tanto para comprobar si una contraseña es correcta se deberá usar la función password_verify.

Después de 3 intentos seguidos y fallidos, se procederá al bloqueo del usuario.
        ◦ Acceder como invitado: Iniciará sesión como invitado, accediendo a invitado.php, donde se mostrará un mensaje de bienvenida, login como “invitado” y la hora a la que se conectó (hora en la que inició la sesión) y un menú con dos opciones: tablón y salir.
            ▪ Tablón: Accederá a tablón.php, pero sólo se visualizarán los anuncios públicos.
            ▪ Salir: Cerramos sesión de invitado y volvemos al index.php.
        ◦ Registrarse:Accederá a registro.php donde se le mostrará un formulario de registro de nuevo usuario, solicitando login, contraseña y email. Recuerda que la contraseña debe aparecer oculta y pedirla por duplicado, y que el campo bloqueado será TRUE. Además del botón GUARDAR deberá aparecer también el botón VOLVER en el caso de que el usuario se arrepienta del registro y desee volver a index.php.
    • voluntario.php: A esta página sólo tendrán acceso los usuarios que hayan sido autentificados. Se controlará su acceso mediante sesiones (las sesiones almacenarán el login del usuario y la hora de conexión), y se mostrará esta información en todo momento. Esta página debe ofrecer un menú que permita crear un anuncio (anuncio.php), acceder al tablón (tablón.php), a la página de preferencias (preferencias.php) y a la desconexión del usuario. El tablón mostrará todos los anuncios (privados y públicos).
    • anuncio.php: Se muestra un formulario para introducir el contenido del anuncio y un checkbox que indique si es privado o no. La fecha y el autor se detectan de forma automática.
    • tablón.php: Se muestra el listado de todos los anuncios, donde se indica el autor del anuncio (login), la fecha de creación y el contenido del anuncio. Los anuncios públicos deberán tener un color diferente a los anuncios privados (texto, fondo o encabezado).
    • preferencias.php: Esta página permitirá al usuario seleccionar el color de fondo con el que se mostrarán todas las páginas. Estas preferencias serán guardadas en una cookie. En caso de que no se hayan establecido preferencias el color por defecto será el blanco. Esta página también ofrecerá la opción de restablecer las preferencias (debe eliminar la cookie).
    • funciones.inc: página que constará de las funciones usadas en la aplicación. Al menos constará de las funciones de acceso y control a la base de datos.
Esta aplicación hará uso de la base de datos "voluntarios3" (cuya estructura se da en el apartado "Recursos Necesarios”). Esta base de datos consta de dos tablas: anunciantes y anuncios.
El usuario con acceso total a dicha base de datos será "dwes" cuyo password es "abc123.". Las contraseñas están almacenadas en la base de datos usando hashing de una sola vía mediante la función crypt, por lo tanto para comprobar si una contraseña es correcta se deberá usar la función password_verify.

El usuario dwes, como administrador de la BD, será el encargado de desbloquear a los nuevos anunciantes y a los anunciantes bloqueados por fallar 3 veces seguidas la contraseña.

RECOMENDACIONES:
    • Para el campo de fecha usar el nuevo type que incorpora HTML: <input type="date" ...>, pero en algunos navegadores como firefox no funciona (podéis ver su comportamiento en el navegador Chrome por ej.), por lo tanto es imprescindible que aunque lo uséis controleis la entrada del texto introducido con el atributo pattern. (Aquí tenéis ejemplos de su uso:http://html5pattern.com/Dates
    • Para ocultar los caracteres del campo de contraseña puedes utilizar el <input type="password"…>.
    • Las opciones del menú pueden ser botones, <a href..>,… pero han de estar siempre visibles.
    • Ten en cuenta la longitud máxima de cada uno de los campos de las tablas de la base de datos.

Auto-evaluación
Por último, tienes que AUTO-EVALUARTE, justificando si fuese necesario las notas de cada apartado. Para ello usarás la plantilla que se encuentra en el apartado de "Recursos Necesarios".

NOTAS IMPORTANTES:
    • No se puede hacer ninguna modificación sobre la estructura de la base de datos ni el usuario de acceso a ésta
    • El fichero .ZIP a subir en la tarea debe contener una carpeta llamada Apellido1_Apellido2_Nombre_DWES03_Tareaque contenga:
        ◦ El documento de texto .ODT con capturas y el mismo documento exportado a .PDF.
        ◦ La hoja de cálculo de auto-evaluación .ODS
        ◦ una carpeta con todos los ficheros necesarios y el proyecto de Netbeans completo.
        ◦ En las propiedades del proyecto PHP de Netbeans, en "Run Configuration" debes seleccionar "Local Web Site". Ojo, es distinto que en anteriores unidades.
