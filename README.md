# DWES03
Tarea 3 Desarrollo Web en Entorno Servidor
Vamos a crear una aplicación de un tablón de anuncios dónde los voluntarios de SinObsolescencia podrán publicar los bienes que desean intercambiar con otros voluntarios o vender al público en general.

Así, los anuncios podrán ser privados o públicos, por lo que dependiendo si accedemos como un usuario registrado de la ONG o como invitado veremos todos o algunos anuncios.

Dicha aplicación constará de las siguientes páginas:

- index.php: Ofrecerá 3 opciones:

Autentificarse mediante usuario y contraseña: Se comprobará que dicho usuario esté dado de alta en la base de datos (en la tabla anunciantes). Si el usuario y contraseña son correctos se creará una sesión y se tendrá acceso a la página voluntario.php.

Las contraseñas están almacenadas en la base de datos usando hashing de una sola vía mediante la función crypt, por lo tanto para comprobar si una contraseña es correcta se deberá usar la función password_verify.

Después de 3 intentos seguidos y fallidos, se procederá al bloqueo del usuario. Acceder como invitado: Iniciará sesión como invitado, accediendo a invitado.php, donde se mostrará un mensaje de bienvenida, login como “invitado” y la hora a la que se conectó (hora en la que inició la sesión) y un menú con dos opciones: tablón y salir.

- Tablón: Accederá a tablón.php, pero sólo se visualizarán los anuncios públicos.

- Salir: Cerramos sesión de invitado y volvemos al index.php.

- Registrarse: Accederá a registro.php donde se le mostrará un formulario de registro de nuevo usuario, solicitando login, contraseña y email. Recuerda que la contraseña debe aparecer oculta y pedirla por duplicado, y que el campo bloqueado será TRUE. Además del botón GUARDAR deberá aparecer también el botón VOLVER en el caso de que el usuario se arrepienta del registro y desee volver a index.php.

- voluntario.php: A esta página sólo tendrán acceso los usuarios que hayan sido autentificados. Se controlará su acceso mediante sesiones (las sesiones almacenarán el login del usuario y la hora de conexión), y se mostrará esta información en todo momento. Esta página debe ofrecer un menú que permita crear un anuncio (anuncio.php), acceder al tablón (tablón.php), a la página de preferencias (preferencias.php) y a la desconexión del usuario. El tablón mostrará todos los anuncios (privados y públicos).

- anuncio.php: Se muestra un formulario para introducir el contenido del anuncio y un checkbox que indique si es privado o no. La fecha y el autor se detectan de forma automática.

- tablón.php: Se muestra el listado de todos los anuncios, donde se indica el autor del anuncio (login), la fecha de creación y el contenido del anuncio. Los anuncios públicos deberán tener un color diferente a los anuncios privados (texto, fondo o encabezado).

- preferencias.php: Esta página permitirá al usuario seleccionar el color de fondo con el que se mostrarán todas las páginas. Estas preferencias serán guardadas en una cookie. En caso de que no se hayan establecido preferencias el color por defecto será el blanco. Esta página también ofrecerá la opción de restablecer las preferencias (debe eliminar la cookie).

- funciones.inc: página que constará de las funciones usadas en la aplicación. Al menos constará de las funciones de acceso y control a la base de datos. Esta aplicación hará uso de la base de datos "voluntarios3" (cuya estructura se da en el apartado "Recursos Necesarios”). Esta base de datos consta de dos tablas: anunciantes y anuncios.

El usuario con acceso total a dicha base de datos será "dwes" cuyo password es "dwes". Las contraseñas están almacenadas en la base de datos usando hashing de una sola vía mediante la función crypt, por lo tanto para comprobar si una contraseña es correcta se deberá usar la función password_verify.

El usuario dwes, como administrador de la BD, será el encargado de desbloquear a los nuevos anunciantes y a los anunciantes bloqueados por fallar 3 veces seguidas la contraseña.
