# Análise: Requirimentos do sistema

Este documento describe os requirimentos para TalkAndEat especificando que funcionalidade ofrecerá e de que xeito.

## Descrición xeral

TalkAndEat (Nombre provisional) será una red social con un fin que no va más allá de entretener, buscar información y divertirse. Esta
red social tendrá como objetivo principal difundir las recetas o comidas que las personas preparen, por lo que,de esta manera todos podremos buscar inspiración en una receta hecha por otra persona o simplemente copiarla y hacerla nosotros mismos. La web consta de varias partes.<br>
    <ul>
        <li>Página principal o index en la que nos aparecerán las publicaciones de las personas que sigamos.</li>
        <li>Página de búsqueda en la que podremos hacer una exploración según que nos apetezca comer, pudiendo elegir entre varios filtros que van desde el dulce a salado, hasta algún ingrediente especial para ver qué podríamos hacer con lo que tengamos por casa o mismo el antojo que tengamos.</li>
        <li>Página de tu perfil, página indispensable en una red social en la que podremos gestionar nuestro perfil.</li>
    </ul>

Según vayan avanzando las prácticas introduciremos a mayores:<br>
    <ul>
        <li> Chat en el que podremos hablar con otros usuarios para poder pedirles opinión, consejo o simplemente hablar con esa persona. </li>
        <li> Basándome un poco en las historias del famoso Instagram, poder establecer un horario en el que poner fotos enseñar a tus seguidores que estás comiendo en el momento, de esta manera se le da un enfoque más natural y con platos menos sofisticados y sin ser preparados para “el postureo”.</li>
    </ul>

## Funcionalidades

Como una red social, en la web las personas usuarias tendrá la posibilidades de realizar las siguientes acciones:

<table>
<thead>
    <tr>
        <th>Action</th>
        <th>Description</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Registrar Usuario</td>
        <td>Las personas usuarias deberán registrarse, dándose así una configuración inicial en la base de datos de la web.</td>
    </tr>
    <tr>
        <td>Eliminar Usuario</td>
        <td>Las personas usuarias tendrán las posibilidad de eliminar su perfil en la base de datos.</td>
    </tr>
    <tr>
        <td>Modificar Usuario</td>
        <td>Cambiar los datos del usuario tales como la contraseña, presentacion o foto de perfil en la base de datos.</td>
    </tr>
    <tr>
        <td>Publicar</td>
        <td>Creación de una entrada de receta en la base de datos.</td>
    </tr>
    <tr>
        <td>Eliminar publicacion</td>
        <td>Eliminar una entrada de receta en la base de datos.</td>
    </tr>
    <tr>
        <td>Comentar</td>
        <td>Creación un comentario para dar un feedback en una publicación.</td>
    </tr>
    <tr>
        <td>Dar "Me Gusta"</td>
        <td>Posibilidad de dar un "like" o "Me gusta" en una publicación.</td>
    </tr>
    <tr>
        <td>Realizar búsqueda</td>
        <td>A través de ciertos filtros la persona usuaria podrá hacer una busqueda general del tipo de publicaciones que le resulten de interés.</td>
    </tr>
    <tr>
        <td>Hablar a otro usuario</td>
        <td>A través de un chat será posible la interacción entre los distintos usuarios de la web.</td>
    </tr>
</tbody>
</table>


## Tipos de usuarios

En la web tendremos los siguientes tipos de restricciones de usuario para las personas usuarias que la conformarán: 
<table>
    <thead>
        <tr><th>Nombre</th> <th>Permisos</th></tr>
    </thead>
    <tbody>
        <tr>
            <td>admin</td>
            <td>Este usuario esta pensado para la gestión de la red social. Por lo cual será único y podrá: <br>
            Obtener un listado de usuarios, buscar un usuario, eliminar usuarios, crear usuarios, hacer publicaciones, eliminar publicaciones tanto propias como de otros usuarios, eliminar cualquier comentario , restringir acciones de un usuario, tales como hacer denegar comentarios.
            </td>
        </tr>
        <tr>
            <td>user</td>
            <td>
            Este será el perfil más común y dedicado al uso de la web el cual prodrá: <br>
            edición de su perfil, borrado de su cuenta, publicacion de contenido, eliminar sus propias publicaciones, comentar publicaciones, borrar comentarios propios, dar un "me gusta" a publicaciones o eliminarlo, buscar publicaciones, buscar otras personas usuarios. </td>
        </tr>
    </tbody>
</table>

## Contorna operacional

Al tratarse de una página web, los recursos necesarios desde el punto del usuario, será bastante básico constando únicamente de conexión a internet y un dispositivo con el acceso directo a esta.

## Normativa
Visto la vigente de ley de protección de datos se seguirá el módelo de diseño "Privacity by Design" intentando solventar todos los problemas de privacidad de los datos en la fase de diseño mismo de la aplicación evitando así largos costos de tiempo una vez este esta finalizada. Para su aplicación optaremos por: 
<ul>
    <li>Restriccion de acceso a los datos y de usuarios.</li>
    <li>Separar los datos personales o de importancia para proteger su integridad</li>
    <li>En temas de seguridad implementaria el uso de contraseñas seguras, la encriptación de datos</li>
    <li>Deberia contar con los permisos necesarios para utilizar cualquier contenido que no sea de mi propiedad, como por ejemplo, imágenes o videos de terceros</li>
    <li>Medidas de seguridad para proteger los datos personales de los usuarios y que se les informe de manera clara y concisa sobre cómo se utilizarán dichos datos</li>
    <li>Realizar mantenimientos y revisiones al final del desarrollo para descubrir y corregir vulnerabilidades. En un futuro uso de la página, esto habría que hacerlo de manera periódica para seguir manteniendo la integridad de la información.
    </li>
    <li>Debería en el Aviso legar aparecer un informe hacia las personas usuarias sobre los derechos de propiedad intelectual de la página web y el contenido que se muestra en ella</li>
    <li>También debería contar con un Aviso Legal y una Política de Privacidad que especifique claramente cómo se recopilan, procesan y almacenan los datos personales de los usuarios, así como los derechos que tienen los usuarios sobre sus datos.</li>
</ul>
En cuanto al punto del impacto medioambiental la normativa vigente no establece requisitos especificos de una página web. Pero para tratar el tema lo ideal y de suponer sería tomar medidas como la eleccion de un hosting que utilice energias renovables.

### Lei de protección de datos

En cuanto a esta ley se refiere hay distintos mecanismos que se utilizan para su cumplimiento tales como: 
<ul>
    <li>Consentimiento del usuario: el consentimiento del usuario tiene que ser expecifico para recoger sus datos y tendra que ser informado de forma voluntaria. En todo momento le usuario debe ser consciente o previamente informado del uso que se le dará a sus datos.</li>
    <li>Medidas de seguridad tales como el hasheo de datos y otras técnicas destinadas a la prevencion de perdidas, destrucción alteraciones o filtraciones de los datos de la persona usuaria.</li>
    <li>Políticas de seguridad las cuales tienen que ser concisas y fáciles de leer para que las persona que vaya a acceder a la web sea consciente de los derechos que tiene como usuarios de los datos.</li>
    <li>En cuento a las Transferencias de datos internacionales. Antes de proceder con el intercambio deberá cerciorarse de que se cumplen los términos de ambos bandos en cuando a la ley de protección de datos se refiere.</li>
    <li>En caso de que el usos de los datos personales impliquen un riesgo para los derechos y libertades del usuario esta acción deberá ser revalorada.</li>
</ul>