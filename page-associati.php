<?php
/**
 * Template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EnlightenedLabs Bootstrap WP
 * @since EnlightenedLabs Bootstrap WP 1.0
 */

	get_header(); 
        $user = get_user_meta($uid = get_current_user_id());
?>
      <div class="row">

        <div class="col-sm-8 blog-main">
            <?php if( is_user_logged_in() ) { 
                if(get_cimyFieldValue($uid, 'PENDING')!="YES" && get_cimyFieldValue($uid,"TESSERA")=="") { ?>
		<p>
			Compilando questo form riceverai una mail contenente la domanda di iscrizione gi&agrave; compilata, da firmare digitalmente
		</p>
		<form action="" method="POST" name="associati">
			<input required class="form-control" type="text" name="nome" id="nome" placeholder="Nome" value="<?php echo $user['first_name'][0]; ?>" />
			<input required class="form-control" type="text" name="cognome" id="cognome" placeholder="Cognome" value="<?php echo $user['last_name'][0]; ?>" />
		        <input required class="form-control" type="text" name="nick" id="nick" placeholder="Nickname di Ingress" />
                        <label for="gplus">Google Plus Profile</label>
                        <input required readonly="1" class="form-control" type="text" value="<?php echo get_cimyFieldValue($uid,'GPLUS'); ?>" id="gplus" />
                        <label for="nato">Nato a</label>
			<input required class="form-control" type="text" name="nato" id="nato" placeholder="Nato a" />
			<label for="data">in data</label><input required class="form-control" type="date" name="data" id="data" placeholder="" />

                        <input required class="form-control" type="text" name="comune" id="comune" placeholder="Residente a" />
			    <select style="width: 24%; display: inline;" name="via-pre">
			        <option value="Via">Via</option>
				<option value="Viale">Viale</option>
				<option value="Piazza">Piazza</option>
                                <option value="Vicolo">Vicolo</option>
				<option value="Calle">Calle</option>
			    </select>
			<input required class="form-control" style="width: 75%; display: inline;" type="text" name="via" id="via" placeholder="" />
			<input required class="form-control" type="text" name="civico" id="civico" placeholder="N Civico" />
			<input required maxlength="5" class="form-control" type="number" name="cap" id="cap" placeholder="CAP" />
                        <input required class="form-control" type="text" name="prov" id="prov" placeholder="Provincia" />
			<input required maxlength="10" class="form-control" type="number" name="tel" id="tel" placeholder="Telefono" />
			<br/>
			Vengo presentato dai seguenti soci:
			<input required class="form-control" type="text" name="socio1" id="socio1" placeholder="Nick socio 1" />
			<input required class="form-control" type="text" name="socio2" id="socio2" placeholder="Nick socio 2" />
			<input required type="hidden" name="action" value="associati" />
			<small> Fai attenzione a scrivere i nomi dei soci correttamente. Altrimenti non potrai continuare </small>
                        <div class="checkbox">
                        <label for="approve">
                            <input style="float: left; width: 15px; height: 20px;" name="approve" id="approve" type="checkbox" /> &nbsp;
                            Ho letto e accetto le <a href="/conditions" target="_blank">condizioni d'uso</a> 
                        </label>
                        </div>
			<input type="submit" class="form-control"/>
		</form>
                <script type="text/javascript" src="/wp-content/themes/enlabs-bootstrap-wp/js/jquery.autocomplete.min.js"></script>
        	<script>
	        var comuni = [];
                (function($){
                  $(document).ready(function() {
        		$.getJSON("https://raw.githubusercontent.com/dakk/Italia.json/master/italia_comuni.json", function(data) {
                        var regioni = data.regioni;
                        for (i in regioni)
                            for (j in regioni[i].province) 
                                for (k in regioni[i].province[j].comuni)
                                    comuni.push({ "value": regioni[i].province[j].comuni[k].nome, "data": { "provincia":regioni[i].province[j].nome, "cap": regioni[i].province[j].comuni[k].cap } });
        		});
	            $("form").submit(function(e) {
			e.preventDefault();
			$.post("/wp-admin/admin-ajax.php", $(this).serialize(), function(data) {
			    console.log(data);
			});
        	    });
                    $("#nato").autocomplete({
                        lookup: comuni,
                        groupBy: "provincia"
                    });
                    $("#comune").autocomplete({
                        lookup: comuni,
                        onSelect: function(s) {
                            $("#prov").attr("readonly",1).val(s.data.provincia);
                            $("#cap").attr("readonly",1).val(s.data.cap);
                            $("#comune").val(s.value);
                        },
                    groupBy: "provincia"
                    });
                  });
	        })(jQuery);
                </script>
                <?php } elseif(get_cimyFieldValue($uid, "TESSERA")=="") { ?>
                    Hai gi&agrave; inviato la tua richiesta di associazione, &egrave; stata presa in carico dall'associazione. <br/>
                    In caso di problemi <a href="/contact-us">contattaci</a> 
                <?php } else { ?>
                    Sei gi&agrave; socio!
                    <script>
                        window.setTimeout(function(){window.location.href="/";}, 3000);
                    </script>
                <?php } ?>
            <?php } else { 
               do_action('wordpress_social_login'); 
            ?>
                <script>
                jQuery(".wp-social-login-connect-with").last().text("Accedi al sito con il tuo account Google per associarti.");
                jQuery(".wp-social-login-provider-google").last().find("img").attr("src","http://www.enlightenedlabs.it/wp-content/themes/enlabs-bootstrap-wp/login/sign-in-button.png");
                </script>
            <?php } ?>
        </div><!-- /.blog-main -->


      </div><!-- /.row -->
      
	<?php get_footer(); ?>
