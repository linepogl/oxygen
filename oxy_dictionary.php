<?php
define('en','en');
define('el','el');
define('fr','fr');
define('de','de');
define('es','es');
abstract class _oxy_dictionary extends ResourceManager {

	public static function txt_locale(){ return Lemma::txt([__FUNCTION__
		,en=>"en_GB"
		,fr=>"fr_FR"
		,el=>"el_GR"
		,de=>"de_DE"
		,es=>"es_ES"
		]);}
	public static function txt_thousands_separator(){ return Lemma::txt([__FUNCTION__
		,en=>","
		,fr=>" "
		,el=>"."
		,de=>"."
		,es=>" "
		]);}
	public static function txt_decimal_separator(){ return Lemma::txt([__FUNCTION__
		,en=>"."
		,fr=>","
		,el=>","
		,de=>","
		,es=>","
		]);}

	public static function txtLanguage(){ return Lemma::txt([__FUNCTION__
		,en=>"Language"
		,fr=>"Langue"
		,el=>"Γλώσσα"
		,de=>"Sprache"
		,es=>"Idioma"
		]);}
	public static function txtName(){ return Lemma::txt([__FUNCTION__
		,en=>"Name"
		,fr=>"Nom"
		,el=>"Όνομα"
		,de=>"Name"
		,es=>"Nombre"
		]);}
	public static function txtSurname(){ return Lemma::txt([__FUNCTION__
		,en=>"Surname"
		,fr=>"Nom"
		,el=>"Επίθετο"
		,de=>"Nachname"
		,es=>"Apellido"
		]);}
	public static function txtFirstName(){ return Lemma::txt([__FUNCTION__
		,en=>"Name"
		,fr=>"Prénom"
		,el=>"Όνομα"
		,de=>"Vorname"
		,es=>"NombrePropio"
		]);}
	public static function txtCompany(){ return Lemma::txt([__FUNCTION__
		,en=>"Company"
		,fr=>"Société"
		,el=>"Εταιρία"
		,de=>"Firma"
		,es=>"Compañía"
		]);}
	public static function txtPosition(){ return Lemma::txt([__FUNCTION__
		,en=>"Position"
		,fr=>"Position"
		,el=>"Θέση"
		,de=>"Position"
		,es=>"Posición"
		]);}
	public static function txtGender(){ return Lemma::txt([__FUNCTION__
		,en=>"Gender"
		,fr=>"Sexe"
		,el=>"Φύλο"
		,de=>"Geschlecht"
		,es=>"Género"
		]);}
	public static function txtMale(){ return Lemma::txt([__FUNCTION__
		,en=>"Male"
		,fr=>"Homme"
		,el=>"Άρρεν"
		,de=>"Männlich"
		,es=>"Hombre"
		]);}
	public static function txtFemale(){ return Lemma::txt([__FUNCTION__
		,en=>"Female"
		,fr=>"Femme"
		,el=>"Θύλη"
		,de=>"Weiblich"
		,es=>"Mujer"
		]);}
	public static function txtPhone(){ return Lemma::txt([__FUNCTION__
		,en=>"Phone"
		,fr=>"Téléphone"
		,el=>"Τηλέφωνο"
		,de=>"Telefon"
		,es=>"Teléfono"
		]);}
	public static function txtEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"E-mail"
		,fr=>"E-mail"
		,el=>"E-mail"
		,de=>"E-Mail"
		,es=>"Email"
		]);}
	public static function txtAddress(){ return Lemma::txt([__FUNCTION__
		,en=>"Address"
		,fr=>"Adresse"
		,el=>"Διεύθυνση"
		,de=>"Adresse"
		,es=>"Dirección"
		]);}
	public static function txtCity(){ return Lemma::txt([__FUNCTION__
		,en=>"City"
		,fr=>"Ville"
		,el=>"Πόλη"
		,de=>"Stadt"
		,es=>"Ciudad"
		]);}
	public static function txtZip(){ return Lemma::txt([__FUNCTION__
		,en=>"Postal code"
		,fr=>"Code postal"
		,el=>"Τ.Κ."
		,de=>"Postleitzahl"
		,es=>"Código postal"
		]);}
	public static function txtCountry(){ return Lemma::txt([__FUNCTION__
		,en=>"Country"
		,fr=>"Pays"
		,el=>"Χώρα"
		,de=>"Land"
		,es=>"País"
		]);}
	public static function txtComments(){ return Lemma::txt([__FUNCTION__
		,en=>"Comments"
		,fr=>"Commentaires"
		,el=>"Σχόλια"
		,de=>"Kommentare"
		,es=>"Comentarios"
		]);}
	public static function txtUsername(){ return Lemma::txt([__FUNCTION__
		,en=>"Username"
		,fr=>"Identifiant"
		,el=>"Username"
		,de=>"Benutzername"
		,es=>"Nombre de usuario"
		]);}
	public static function txtPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Password"
		,fr=>"Mot de passe"
		,el=>"Κωδικός"
		,de=>"Passwort"
		,es=>"Contraseña"
		]);}
	public static function txtOldPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Old password"
		,fr=>"Ancien mot de passe"
		,el=>"Παλιός κωδικός"
		,de=>"Altes Passwort"
		,es=>"Antigua Contraseña"
		]);}
	public static function txtNewPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"New password"
		,fr=>"Nouveau mot de passe"
		,el=>"Νέος κωδικός"
		,de=>"Neues Passwort"
		,es=>"Nueva Contraseña"
		]);}
	public static function txtConfirmPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Confirm"
		,fr=>"Confirmer"
		,el=>"Επιβεβαίωση"
		,de=>"Passwort Bestätigen"
		,es=>"Confirmar"
		]);}
	public static function txtDateCreated(){ return Lemma::txt([__FUNCTION__
		,en=>"Date created"
		,fr=>"Date de création"
		,el=>"Ημ.δημιουργίας"
		,de=>"Erstellungsdatum"
		,es=>"Fecha de creación"
		]);}
	public static function txtDateModified(){ return Lemma::txt([__FUNCTION__
		,en=>"Date modified"
		,fr=>"Date de modification"
		,el=>"Ημ.μεταβολής"
		,de=>"Modifizierungsdatum"
		,es=>"Fecha de modificación"
		]);}
	public static function txtEmailRcpt(){ return Lemma::txt([__FUNCTION__
		,en=>"To"
		,fr=>"A"
		,el=>"Πρoς"
		,de=>"E-Mail-Empfänger"
		,es=>"Para"
		]);}
	public static function txtEmailSubject(){ return Lemma::txt([__FUNCTION__
		,en=>"Subject"
		,fr=>"Sujet"
		,el=>"Θέμα"
		,de=>"E-Mail Betreff"
		,es=>"Asunto"
		]);}
	public static function txtEmailBody(){ return Lemma::txt([__FUNCTION__
		,en=>"Body"
		,fr=>"Message"
		,el=>"Κείμενο"
		,de=>"E-Mail Text"
		,es=>"Mensaje"
		]);}
	public static function txtEmailFrom(){ return Lemma::txt([__FUNCTION__
		,en=>"From"
		,fr=>"De"
		,el=>"Από"
		,de=>"E-Mail von"
		,es=>"De"
		]);}
	public static function txtDateSent(){ return Lemma::txt([__FUNCTION__
		,en=>"Date sent"
		,fr=>"Date d'envoi"
		,el=>"Ημ.αποστολής"
		,de=>"Gesendet am"
		,es=>"Fecha de envío"
		]);}
	public static function txtLockedAccount(){ return Lemma::txt([__FUNCTION__
		,en=>"Locked account"
		,fr=>"Compte bloqué"
		,el=>"Κλειδωμένος λογαριασμός"
		,de=>"Gesperrtes Konto"
		,es=>"Cuenta Bloqueada"
		]);}
	public static function txtFile(){ return Lemma::txt([__FUNCTION__
		,en=>"File"
		,fr=>"Fichier"
		,el=>"Αρχείο"
		,de=>"Datei"
		,es=>"Archivo"
		]);}



	public static function txtDate(){ return Lemma::txt([__FUNCTION__
		,en=>"Date"
		,fr=>"Date"
		,el=>"Ημερομηνία"
		,de=>"Datum"
		,es=>"Fecha"
		]);}
	public static function txtTime(){ return Lemma::txt([__FUNCTION__
		,en=>"Time"
		,fr=>"Heure"
		,el=>"Ώρα"
		,de=>"Zeit"
		,es=>"Hora"
		]);}
	public static function txtToday(){ return Lemma::txt([__FUNCTION__
		,en=>"Today"
		,fr=>"Aujourd'hui"
		,el=>"Σήμερα"
		,de=>"Heute"
		,es=>"Hoy"
		]);}
	public static function txtTomorrow(){ return Lemma::txt([__FUNCTION__
		,en=>"Tomorrow"
		,fr=>"Demain"
		,el=>"Αύριο"
		,de=>"Morgen"
		,es=>"Mañana"
		]);}
	public static function txtYesterday(){ return Lemma::txt([__FUNCTION__
		,en=>"Yesterday"
		,fr=>"Hier"
		,el=>"Xθες"
		,de=>"Gestern"
		,es=>"Ayer"
		]);}
	public static function txtNow(){ return Lemma::txt([__FUNCTION__
		,en=>"Now"
		,fr=>"Maintenant"
		,el=>"Τώρα"
		,de=>"Jetzt"
		,es=>"Ahora"
		]);}
	public static function txtAM(){ return Lemma::txt([__FUNCTION__
		,en=>"a.m."
		,fr=>"avant-midi"
		,el=>"π.μ."
		,de=>"Uhr"
		,es=>"a. m."
		]);}
	public static function txtPM(){ return Lemma::txt([__FUNCTION__
		,en=>"p.m."
		,fr=>"après-midi"
		,el=>"μ.μ."
		,de=>"Uhr"
		,es=>"p. m."
		]);}
	public static function txtDay(){ return Lemma::txt([__FUNCTION__
		,en=>"Day"
		,fr=>"Jour"
		,el=>"Ημέρα"
		,de=>"Tag"
		,es=>"Día"
		]);}
	public static function txtDayOfWeek(){ return Lemma::txt([__FUNCTION__
		,en=>"Day of week"
		,fr=>"Jour de la semaine"
		,el=>"Ημέρα της εβδομάδας"
		,de=>"Wochentag"
		,es=>"Día De La Semana"
		]);}
	public static function txtNight(){ return Lemma::txt([__FUNCTION__
		,en=>"Night"
		,fr=>"Nuit"
		,el=>"Νύχτα"
		,de=>"Nacht"
		,es=>"Noche"
		]);}
	public static function txtDays(){ return Lemma::txt([__FUNCTION__
		,en=>"Days"
		,fr=>"Jours"
		,el=>"Ημέρες"
		,de=>"Tage"
		,es=>"Días"
		]);}
	public static function txtXDays(){ return Lemma::txt([__FUNCTION__
		,en=>"%s days"
		,fr=>"%s jours"
		,el=>"%s ημέρες"
		,de=>"e%s Tage "
		,es=>"%s días"
		]);}
	public static function txtXDaysAgo(){ return Lemma::txt([__FUNCTION__
		,en=>"%s days ago"
		,fr=>"Il y a %s jours"
		,el=>"Πριν από %s ημέρες"
		,de=>"Vor % Tagen"
		,es=>"Hace %s Días"
		]);}
	public static function txtXTimeAgo(){ return Lemma::txt([__FUNCTION__
		,en=>"%s ago"
		,fr=>"Il y a %s"
		,el=>"Πριν από %s"
		,de=>"Vor %s"
		,es=>"Hace %s"
		]);}
	public static function txtInXDays(){ return Lemma::txt([__FUNCTION__
		,en=>"In %s days"
		,fr=>"Dans %s jours"
		,el=>"Σε %s ημέρες"
		,de=>"In % Tagen"
		,es=>"En %s días"
		]);}
	public static function txtInXTime(){ return Lemma::txt([__FUNCTION__
		,en=>"In %s"
		,fr=>"Dans %s"
		,el=>"Σε %s"
		,de=>"In%s"
		,es=>"En %s"
		]);}
	public static function txtTimeZone(){ return Lemma::txt([__FUNCTION__
		,en=>"Time zone"
		,fr=>"Fuseau horaire"
		,el=>"Ζώνη ώρας"
		,de=>"Zeitzone"
		,es=>"Zona Horaria"
		]);}
	public static function txtJanuary(){ return Lemma::txt([__FUNCTION__
		,en=>"January"
		,fr=>"janvier"
		,el=>"Ιανουάριος"
		,de=>"Januar"
		,es=>"enero"
		]);}
	public static function txtFebruary(){ return Lemma::txt([__FUNCTION__
		,en=>"February"
		,fr=>"février"
		,el=>"Φεβρουάριος"
		,de=>"Februar"
		,es=>"febrero"
		]);}
	public static function txtMarch(){ return Lemma::txt([__FUNCTION__
		,en=>"March"
		,fr=>"mars"
		,el=>"Μάρτιος"
		,de=>"März"
		,es=>"marzo"
		]);}
	public static function txtApril(){ return Lemma::txt([__FUNCTION__
		,en=>"April"
		,fr=>"avril"
		,el=>"Απρίλιος"
		,de=>"April"
		,es=>"abril"
		]);}
	public static function txtMay(){ return Lemma::txt([__FUNCTION__
		,en=>"May"
		,fr=>"mai"
		,el=>"Μάιος"
		,de=>"Mai"
		,es=>"mayo"
		]);}
	public static function txtJune(){ return Lemma::txt([__FUNCTION__
		,en=>"June"
		,fr=>"juin"
		,el=>"Ιούνιος"
		,de=>"Juni"
		,es=>"junio"
		]);}
	public static function txtJuly(){ return Lemma::txt([__FUNCTION__
		,en=>"July"
		,fr=>"juillet"
		,el=>"Ιούλιος"
		,de=>"Juli"
		,es=>"julio"
		]);}
	public static function txtAugust(){ return Lemma::txt([__FUNCTION__
		,en=>"August"
		,fr=>"août"
		,el=>"Αύγουστος"
		,de=>"August"
		,es=>"agosto"
		]);}
	public static function txtSeptember(){ return Lemma::txt([__FUNCTION__
		,en=>"September"
		,fr=>"septembre"
		,el=>"Σεπτέμβριος"
		,de=>"September"
		,es=>"septiembre"
		]);}
	public static function txtOctober(){ return Lemma::txt([__FUNCTION__
		,en=>"October"
		,fr=>"octobre"
		,el=>"Οκτώβριος"
		,de=>"Oktober"
		,es=>"octubre"
		]);}
	public static function txtNovember(){ return Lemma::txt([__FUNCTION__
		,en=>"November"
		,fr=>"novembre"
		,el=>"Νοέμβριος"
		,de=>"November"
		,es=>"noviembre"
		]);}
	public static function txtDecember(){ return Lemma::txt([__FUNCTION__
		,en=>"December"
		,fr=>"décembre"
		,el=>"Δεκέμβριος"
		,de=>"Dezember"
		,es=>"diciembre"
		]);}

	public static function txtJan_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jan"
		,fr=>"jan."
		,el=>"Ιαν."
		,de=>"Jan"
		,es=>"ene."
		]);}
	public static function txtFeb_(){ return Lemma::txt([__FUNCTION__
		,en=>"Feb"
		,fr=>"fév."
		,el=>"Φεβ."
		,de=>"Feb."
		,es=>"feb."
		]);}
	public static function txtMar_(){ return Lemma::txt([__FUNCTION__
		,en=>"Mar"
		,fr=>"mars"
		,el=>"Μάρ."
		,de=>"Mar."
		,es=>"mar."
		]);}
	public static function txtApr_(){ return Lemma::txt([__FUNCTION__
		,en=>"Apr"
		,fr=>"avr."
		,el=>"Απρ."
		,de=>"Apr."
		,es=>"abr."
		]);}
	public static function txtMay_(){ return Lemma::txt([__FUNCTION__
		,en=>"May"
		,fr=>"mai"
		,el=>"Μάι."
		,de=>"Mai"
		,es=>"may."
		]);}
	public static function txtJun_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jun"
		,fr=>"juin"
		,el=>"Ιούν."
		,de=>"Jun."
		,es=>"jun."
		]);}
	public static function txtJul_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jul"
		,fr=>"juil"
		,el=>"Ιούλ."
		,de=>"Jul."
		,es=>"jul."
		]);}
	public static function txtAug_(){ return Lemma::txt([__FUNCTION__
		,en=>"Aug"
		,fr=>"août"
		,el=>"Αύγ."
		,de=>"Aug."
		,es=>"ago."
		]);}
	public static function txtSep_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sep"
		,fr=>"sep."
		,el=>"Σεπ."
		,de=>"Sept."
		,es=>"sep."
		]);}
	public static function txtOct_(){ return Lemma::txt([__FUNCTION__
		,en=>"Oct"
		,fr=>"oct."
		,el=>"Οκτ."
		,de=>"Okt."
		,es=>"oct."
		]);}
	public static function txtNov_(){ return Lemma::txt([__FUNCTION__
		,en=>"Nov"
		,fr=>"nov."
		,el=>"Νοέ."
		,de=>"Nov."
		,es=>"nov."
		]);}
	public static function txtDec_(){ return Lemma::txt([__FUNCTION__
		,en=>"Dec"
		,fr=>"déc."
		,el=>"Δεκ."
		,de=>"Dez."
		,es=>"dic."
		]);}

	public static function txtMonday(){ return Lemma::txt([__FUNCTION__
		,en=>"Monday"
		,fr=>"lundi"
		,el=>"Δευτέρα"
		,de=>"Montag"
		,es=>"lunes"
		]);}
	public static function txtTuesday(){ return Lemma::txt([__FUNCTION__
		,en=>"Tuesday"
		,fr=>"mardi"
		,el=>"Τρίτη"
		,de=>"Dienstag"
		,es=>"martes"
		]);}
	public static function txtWednesday(){ return Lemma::txt([__FUNCTION__
		,en=>"Wednesday"
		,fr=>"mercredi"
		,el=>"Τετάρτη"
		,de=>"Mitwoch"
		,es=>"miércoles"
		]);}
	public static function txtThursday(){ return Lemma::txt([__FUNCTION__
		,en=>"Thursday"
		,fr=>"jeudi"
		,el=>"Πέμπτη"
		,de=>"Donnerstag"
		,es=>"jueves"
		]);}
	public static function txtFriday(){ return Lemma::txt([__FUNCTION__
		,en=>"Friday"
		,fr=>"vendredi"
		,el=>"Παρασκευή"
		,de=>"Freitag"
		,es=>"viernes"
		]);}
	public static function txtSaturday(){ return Lemma::txt([__FUNCTION__
		,en=>"Saturday"
		,fr=>"samedi"
		,el=>"Σάββατο"
		,de=>"Samstag"
		,es=>"sábado"
		]);}
	public static function txtSunday(){ return Lemma::txt([__FUNCTION__
		,en=>"Sunday"
		,fr=>"dimanche"
		,el=>"Κυριακή"
		,de=>"Sonntag"
		,es=>"domingo"
		]);}

	public static function txtMon_(){ return Lemma::txt([__FUNCTION__
		,en=>"Mon"
		,fr=>"lun."
		,el=>"Δευ."
		,de=>"Mo_"
		,es=>"lun."
		]);}
	public static function txtTue_(){ return Lemma::txt([__FUNCTION__
		,en=>"Tue"
		,fr=>"mar."
		,el=>"Τρί."
		,de=>"Di_"
		,es=>"mar."
		]);}
	public static function txtWed_(){ return Lemma::txt([__FUNCTION__
		,en=>"Wed"
		,fr=>"mer."
		,el=>"Τετ."
		,de=>"Mi_"
		,es=>"mié."
		]);}
	public static function txtThu_(){ return Lemma::txt([__FUNCTION__
		,en=>"Thu"
		,fr=>"jeu."
		,el=>"Πέμ."
		,de=>"Do_"
		,es=>"jue."
		]);}
	public static function txtFri_(){ return Lemma::txt([__FUNCTION__
		,en=>"Fri"
		,fr=>"ven."
		,el=>"Παρ."
		,de=>"F_"
		,es=>"vie."
		]);}
	public static function txtSat_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sat"
		,fr=>"sam."
		,el=>"Σάβ."
		,de=>"Sa_"
		,es=>"sáb."
		]);}
	public static function txtSun_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sun"
		,fr=>"dim."
		,el=>"Κυρ."
		,de=>"So_"
		,es=>"dom."
		]);}





	public static function txtSubmit(){ return Lemma::txt([__FUNCTION__
		,en=>"Submit"
		,fr=>"Soumettre"
		,el=>"Αποστολή"
		,de=>"Absenden"
		,es=>"Enviar"
		]);}
	public static function txtLogin(){ return Lemma::txt([__FUNCTION__
		,en=>"Login"
		,fr=>"Connexion"
		,el=>"Login"
		,de=>"Anmeldung"
		,es=>"Acceder"
		]);}
	public static function txtLogoff(){ return Lemma::txt([__FUNCTION__
		,en=>"Logoff"
		,fr=>"Déconnexion"
		,el=>"Logoff"
		,de=>"Abmeldung"
		,es=>"Salir"
		]);}
	public static function txtBack(){ return Lemma::txt([__FUNCTION__
		,en=>"Back"
		,fr=>"Retour"
		,el=>"Επιστροφή"
		,de=>"Zurück"
		,es=>"Atrás"
		]);}
	public static function txtOK(){ return Lemma::txt([__FUNCTION__
		,en=>"OK"
		,fr=>"OK"
		,el=>"OK"
		,de=>"OK"
		,es=>"OK"
		]);}
	public static function txtApply(){ return Lemma::txt([__FUNCTION__
		,en=>"Apply"
		,fr=>"Appliquer"
		,el=>"Εφαρμογή"
		,de=>"Anwenden"
		,es=>"Aplicar"
		]);}
	public static function txtCancel(){ return Lemma::txt([__FUNCTION__
		,en=>"Cancel"
		,fr=>"Annuler"
		,el=>"Άκυρο"
		,de=>"Abbrechen"
		,es=>"Cancelar"
		]);}
	public static function txtSend(){ return Lemma::txt([__FUNCTION__
		,en=>"Send"
		,fr=>"Envoyer"
		,el=>"Αποστολή"
		,de=>"Senden"
		,es=>"Enviar"
		]);}
	public static function txtSave(){ return Lemma::txt([__FUNCTION__
		,en=>"Save"
		,fr=>"Sauvegarder"
		,el=>"Αποθήκευση"
		,de=>"Speichern"
		,es=>"Guardar"
		]);}
	public static function txtDelete(){ return Lemma::txt([__FUNCTION__
		,en=>"Delete"
		,fr=>"Supprimer"
		,el=>"Διαγραφή"
		,de=>"Löschen"
		,es=>"Eliminar"
		]);}
	public static function txtRename(){ return Lemma::txt([__FUNCTION__
		,en=>"Rename"
		,fr=>"Renommer"
		,el=>"Μετονομασία"
		,de=>"Umbenennen"
		,es=>"Renombrar"
		]);}
	public static function txtPrint(){ return Lemma::txt([__FUNCTION__
		,en=>"Print"
		,fr=>"Imprimer"
		,el=>"Εκτύπωση"
		,de=>"Drucken"
		,es=>"Imprimir"
		]);}
	public static function txtClose(){ return Lemma::txt([__FUNCTION__
		,en=>"Close"
		,fr=>"Fermer"
		,el=>"Κλείσιμο"
		,de=>"Schließen"
		,es=>"Cerrar"
		]);}
	public static function txtAsk(){ return Lemma::txt([__FUNCTION__
		,en=>"Ask"
		,fr=>"Demander"
		,el=>"Ερώτηση"
		,de=>"Fragen"
		,es=>"Preguntar"
		]);}
	public static function txtUpdate(){ return Lemma::txt([__FUNCTION__
		,en=>"Update"
		,fr=>"Mettre à jour"
		,el=>"Ανανέωση"
		,de=>"Aktualisieren"
		,es=>"Actualizar"
		]);}
	public static function txtSelect(){ return Lemma::txt([__FUNCTION__
		,en=>"Select"
		,fr=>"Sélectionner"
		,el=>"Επιλογή"
		,de=>"Wählen"
		,es=>"Seleccionar"
		]);}
	public static function txtCompare(){ return Lemma::txt([__FUNCTION__
		,en=>"Compare"
		,fr=>"Comparer"
		,el=>"Σύγκριση"
		,de=>"Vergleichen"
		,es=>"Comparar"
		]);}
	public static function txtSearch(){ return Lemma::txt([__FUNCTION__
		,en=>"Search"
		,fr=>"Rechercher"
		,el=>"Αναζήτηση"
		,de=>"Suchen"
		,es=>"Buscar"
		]);}
	public static function txtYes(){ return Lemma::txt([__FUNCTION__
		,en=>"Yes"
		,fr=>"Oui"
		,el=>"Ναι"
		,de=>"Ja"
		,es=>"Sí"
		]);}
	public static function txtNo(){ return Lemma::txt([__FUNCTION__
		,en=>"No"
		,fr=>"Non"
		,el=>"Όχι"
		,de=>"Nein"
		,es=>"No"
		]);}
	public static function txtNext(){ return Lemma::txt([__FUNCTION__
		,en=>"Next"
		,fr=>"Suivant"
		,el=>"Επόμενο"
		,de=>"Weiter"
		,es=>"Siguiente"
		]);}
	public static function txtPrevious(){ return Lemma::txt([__FUNCTION__
		,en=>"Previous"
		,fr=>"Précédent"
		,el=>"Προηγούμενο"
		,de=>"Vorherige"
		,es=>"Anterior"
		]);}
	public static function txtModify(){ return Lemma::txt([__FUNCTION__
		,en=>"Modify"
		,fr=>"Modifier"
		,el=>"Επεξεργασία"
		,de=>"Ändern"
		,es=>"Modificar"
		]);}
	public static function txtContinue(){ return Lemma::txt([__FUNCTION__
		,en=>"Continue"
		,fr=>"Continuer"
		,el=>"Συνέχεια"
		,de=>"Fortfahren"
		,es=>"Continuar"
		]);}

	public static function txtHome(){ return Lemma::txt([__FUNCTION__
		,en=>"Home"
		,fr=>"Accueil"
		,el=>"Αρχική"
		,de=>"Startseite"
		,es=>"Inicio"
		]);}
	public static function txtSettings(){ return Lemma::txt([__FUNCTION__
		,en=>"Settings"
		,fr=>"Paramètres"
		,el=>"Ρυθμίσεις"
		,de=>"Einstellungen"
		,es=>"Ajustes"
		]);}


	public static function txtUser(){ return Lemma::txt([__FUNCTION__
		,en=>"User"
		,fr=>"Utilisateur"
		,el=>"Χρήστης"
		,de=>"Benutzer"
		,es=>"Usuario"
		]);}
	public static function txtUsers(){ return Lemma::txt([__FUNCTION__
		,en=>"Users"
		,fr=>"Utilisateurs"
		,el=>"Χρήστες"
		,de=>"Benutzer"
		,es=>"Usuarios"
		]);}
	public static function txtChangePassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Change password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort ändern"
		,es=>"Cambiar Contraseña"
		]);}
	public static function txtResetPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort zurücksetzen"
		,es=>"Restablecer Contraseña"
		]);}
	public static function txtResetPasswordLong(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset password"
		,fr=>"Réinitialiser le mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort zurücksetzen"
		,es=>"Restablecer Contraseña"
		]);}
	public static function txtReset(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset"
		,fr=>"Réinitialiser"
		,el=>"Αλλαγή"
		,de=>"Zurücksetzen"
		,es=>"Restablecer"
		]);}
	public static function txtChangeProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Change profile"
		,fr=>"Profil"
		,el=>"Αλλαγή προφίλ"
		,de=>"Profil wechseln"
		,es=>"Cambiar Perfil"
		]);}
	public static function txtModifyProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Modify profile"
		,fr=>"Modifier profil"
		,el=>"Αλλαγή προφίλ"
		,de=>"Profil ändern"
		,es=>"Modificar Perfil"
		]);}

	public static function txtError(){ return Lemma::txt([__FUNCTION__
		,en=>"Error"
		,fr=>"Erreur"
		,el=>"Σφάλμα"
		,de=>"Fehler"
		,es=>"Error"
		]);}

	public static function txtActionLogin(){ return Lemma::txt([__FUNCTION__
		,en=>"Login"
		,fr=>"Connexion"
		,el=>"Login"
		,de=>"Anmeldung"
		,es=>"Acceder"
		]);}
	public static function txtActionLogoff(){ return Lemma::txt([__FUNCTION__
		,en=>"Logoff"
		,fr=>"Déconnexion"
		,el=>"Logoff"
		,de=>"Abmeldung"
		,es=>"Salir"
		]);}
	public static function txtActionChangePassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Change password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort ändern"
		,es=>"Cambiar Contraseña"
		]);}
	public static function txtActionChangeProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Change profile"
		,fr=>"Profil d'utilisateur"
		,el=>"Προφίλ χρήστη"
		,de=>"Profil wechseln"
		,es=>"Perfil de susuario"
		]);}
	public static function txtActionCreateUser(){ return Lemma::txt([__FUNCTION__
		,en=>"Create user"
		,fr=>"Création d'un utilisateur"
		,el=>"Δημιουργία χρήστη"
		,de=>"Benutzer erstellen"
		,es=>"Crear Usuario"
		]);}
	public static function txtActionForgottenPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Forgotten your password?"
		,fr=>"Mot de passe oublié ?"
		,el=>"Υπενθύμιση κωδικού"
		,de=>"Passwort vergessen"
		,es=>"¿Olvidó su contraseña?"
		]);}

	public static function txtMsgCannotDisplayWebPage(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot display the web page."
		,fr=>"La page ne peut pas être affichée."
		,el=>"Η προβολή της σελίδας δεν είναι δυνατή."
		,de=>"Website kann nicht angezeigt werden"
		,es=>"No se puede mostrar la página"
		]);}
	public static function txtMsgUnderConstruction(){ return Lemma::txt([__FUNCTION__
		,en=>"Under construction."
		,fr=>"En construction."
		,el=>"Υπό κατασκευή."
		,de=>"Im Aufbau"
		,es=>"En construcción."
		]);}
	public static function txtMsgNotImplemented(){ return Lemma::txt([__FUNCTION__
		,en=>"Not implemented."
		,fr=>"Non implémenté."
		,el=>"Μη υλοποιημένο."
		,de=>"Nicht implementiert"
		,es=>"No Implementado"
		]);}
	public static function txtMsgPageNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Page not found."
		,fr=>"La page n'était pas trouvée."
		,el=>"Η σελίδα δεν βρέθηκε."
		,de=>"Seite nicht gefunden"
		,es=>"Página No Encontrada"
		]);}
	public static function txtMsgObjectNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Object not found."
		,fr=>"L'objet n'était pas trouvé."
		,el=>"Το αντικείμενο δεν βρέθηκε."
		,de=>"Objekt nicht gefunden"
		,es=>"Objeto No Encontrado"
		]);}
	public static function txtMsgAccessDenied(){ return Lemma::txt([__FUNCTION__
		,en=>"Access denied."
		,fr=>"Accès refusé."
		,el=>"Μη επιτρεπτή πρόσβαση."
		,de=>"Zugriff verweigert"
		,es=>"Acceso Denegado"
		]);}
	public static function txtMsgInvalidUsername(){ return Lemma::txt([__FUNCTION__
		,en=>"Unknown user."
		,fr=>"Utilisateur inconnu."
		,el=>"Λάθος όνομα χρήστη."
		,de=>"Unbekannter Benutzer"
		,es=>"Nombre De Usuario No Válido"
		]);}
	public static function txtMsgInvalidPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid password."
		,fr=>"Mot de passe incorrect."
		,el=>"Λάθος κωδικός πρόσβασης."
		,de=>"Ungültiges Passwort"
		,es=>"Contraseña No Válida"
		]);}
	public static function txtMsgInvalidUsernameOrPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid username or password."
		,fr=>"Utilisateur inconnu ou mot de passe incorrect."
		,el=>"Λάθος όνομα χρήστη ή λάθος κωδικός πρόσβασης."
		,de=>"Unbekannter/s Benutzername oder Passwort"
		,es=>"Nombre De Usuario o Contraseña No Válidos"
		]);}
	public static function txtMsgMultipleUsersFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Multiple users found."
		,fr=>"Plusieurs utilisateurs trouvés."
		,el=>"Βρέθηκαν πολλαπλοί χρήστες."
		,de=>"Mehrere Benutzer gefunden"
		,es=>"Varios Usuarios Encontrados"
		]);}
	public static function txtMsgEmailSentSuccessfully(){ return Lemma::txt([__FUNCTION__
		,en=>"The e-mail has been sent successfully."
		,fr=>"Le message e-mail a été bien envoyé."
		,el=>"Η αποστολή του e-mail έγινε επιτυχώς."
		,de=>"Die E-Mail wurde erfolgreich versandt"
		,es=>"Email Enviado Exitosamente"
		]);}
	public static function txtMsgInvalidEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid e-mail address."
		,fr=>"L'adresse e-mail n'est pas valide."
		,el=>"Λάθος διεύθυνση e-mail."
		,de=>"Ungültige E-Mail-Adresse"
		,es=>"Email No Válido"
		]);}
	public static function txtMsgInvalidPhone(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid phone number. Please use international format (+123456789)."
		,fr=>"Le numéro n'est pas valide. Veuillez utilisez le format international (+123456789)."
		,el=>"Λάθος αριθμός τηλεφώνου. Χρησιμοποιήστε το διεθνές πρότυπο (+123456789)."
		,de=>"Ungültige Telefonnummer. Bitte verwenden Sie das internationale Format (+123456789)."
		,es=>"Teléfono No válido. Por favor, use el formato internacional (+123456789)."
		]);}
	public static function txtMsgInvalidURL(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid address."
		,fr=>"L'adresse n'est pas valide."
		,el=>"Λάθος διεύθυνση."
		,de=>"Ungültige Adresse"
		,es=>"Dirección No válida."
		]);}
	public static function txtMsgInvalidValue(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid value."
		,fr=>"Le valeur n'est pas valide."
		,el=>"Λάθος τιμή."
		,de=>"Ungültiger Wert"
		,es=>"Valor No Válido."
		]);}

	public static function txtMsgAccountBanned(){ return Lemma::txt([__FUNCTION__
		,en=>"User account locked."
		,fr=>"Compte utilisateur bloqué."
		,el=>"Kλειδωμένος λογαριασμός χρήστη."
		,de=>"Benutzerkonto gesperrt"
		,es=>"Cuenta de Usuario Baneada."
		]);}

	public static function txtMsgPasswordsDoNotMatch(){ return Lemma::txt([__FUNCTION__
		,en=>"The passwords do not match."
		,fr=>"Les deux mots de passe ne sont pas identiques."
		,el=>"Οι κωδικοί δεν είναι ίδιοι."
		,de=>"Die Passwörter stimmen nicht überein"
		,es=>"Las Contraseñas No Coinciden."
		]);}

	public static function txtMsgMandatoryFields(){ return Lemma::txt([__FUNCTION__
		,en=>"The fields with * are mandatory."
		,fr=>"Les champs avec * sont obligatoires."
		,el=>"Τα πεδία με * είναι υποχρεωτικά."
		,de=>"Mit * gekennzeichnete Felder sind obligatorisch."
		,es=>"Los Campos con * son Obligatorios."
		]);}

	public static function txtMsgMandatoryField(){ return Lemma::txt([__FUNCTION__
		,en=>"This field is mandatory."
		,fr=>"Ce champ est obligatoire."
		,el=>"Το πεδίο αυτό είναι υποχρεωτικό."
		,de=>"Dieses Feld ist obligatorisch."
		,es=>"Este Campo es Obligatorio."
		]);}

	public static function txtMsgFieldMandatoryInAllLanguages(){ return Lemma::txt([__FUNCTION__
		,en=>"This field is mandatory in all languages."
		,fr=>"Ce champ est obligatoire en toutes les langues."
		,el=>"Το πεδίο αυτό είναι υποχρεωτικό σε όλες τις γλώσσες."
		,de=>"Dieses Feld ist in allen Sprachen obligatorisch."
		,es=>"Este Campo es Obligatorio En Todas Las Lenguas."
		]);}

	public static function txtMsgPasswordChanged(){ return Lemma::txt([__FUNCTION__
		,en=>"The password has been changed."
		,fr=>"Le mot de passe a été changé."
		,el=>"Ο κωδικός πρόσβασης άλλαξε."
		,de=>"Das Passwort wurde geändert."
		,es=>"La Contraseña se ha cambiado."
		]);}

	public static function txtMsgProfileChanged(){ return Lemma::txt([__FUNCTION__
		,en=>"The user profile has been changed."
		,fr=>"Le profil de l'utilisateur a été changé."
		,el=>"Το προφίλ χρήστη άλλαξε."
		,de=>"Das Benutzerprofil wurde geändert."
		,es=>"El perfil de usuario se ha cambiado."
		]);}

	public static function txtMsgUsernameExists(){ return Lemma::txt([__FUNCTION__
		,en=>"This username already exists."
		,fr=>"Cet utilisateur existe déjà."
		,el=>"Αυτό το όνομα χρήστη υπάρχει ήδη."
		,de=>"Diesen Benutzernamen gibt es bereits."
		,es=>"Este nombre de usuario ya existe."
		]);}

	public static function txtMsgCannotSendEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while sending e-mail."
		,fr=>"Erreur lors de l'envoi d'e-mail."
		,el=>"Σφάλμα κατά την αποστολή e-mail."
		,de=>"Fehler beim Senden der E-Mail."
		,es=>"Error al enviar el email."
		]);}

	public static function txtMsgCannotConnectToDatabase(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while connecting to the database."
		,fr=>"Erreur lors de la connexion à la base de données."
		,el=>"Σφάλμα κατά την σύνδεση με τη βάση δεδομένων."
		,de=>"Fehler beim Verbinden mit der Datenbank"
		,es=>"Error al conectar a la base de datos."
		]);}
	public static function txtMsgCannotCreateDatabase(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while creating database schema."
		,fr=>"Erreur lors de la création de la base de données."
		,el=>"Σφάλμα κατά την δημιουργία νέας βάσης δεδομένων."
		,de=>"Fehler beim Erstellen des Datenbankschemas."
		,es=>"Error al crear la base de datos."
		]);}

	public static function txtMsgCannotDeleteCurrentUser(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot delete current user."
		,fr=>"Il est impossible de supprimer l'utilisateur courant."
		,el=>"Δεν είναι δυνατό να διαγραφεί ο τρέχον χρήστης."
		,de=>"Der aktuelle Benutzer kann nicht gelöscht werden."
		,es=>"No Se Puede Eliminar Al Usuario Actual"
		]);}

	public static function txtMsgObjectXNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"This object was not found: %s."
		,fr=>"Objet non trouvé : %s."
		,el=>"Το αντικείμενο αυτό δεν βρέθηκε: [%s]."
		,de=>"Dieses Objekt wurde nicht gefunden: %s"
		,es=>"El Objeto %s No Se Encontró"
		]);}
	public static function txtMsgObjectXAlreadyExists(){ return Lemma::txt([__FUNCTION__
		,en=>"This object already exists: %s."
		,fr=>"Cet objet existe déjà : %s."
		,el=>"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		,de=>"Dieses Objekt gibt es bereits: %s"
		,es=>"Este objeto ya existe: %s."
		]);}
	public static function txtMsgCannotDeleteSystemObject(){ return Lemma::txt([__FUNCTION__
		,en=>"This object is used by the system."
		,fr=>"Cet objet est utilisé par le système."
		,el=>"Το αντικείμενο είναι απαραίτητο για την ομαλή λειτουργεία του συστήματος."
		,de=>"Dieses Objekt wird vom System verwendet."
		,es=>"El objeto está siendo usado por el sistema."
		]);}


	public static function txtMsgXItemNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"This object was not found [%s %s]."
		,fr=>"Objet non trouvé [%s %s]."
		,el=>"Το αντικείμενο αυτό δεν βρέθηκε: [%s %s]."
		,de=>"Dieses Objekt wurde nicht gefunden [%s %s]."
		,es=>"Este objeto no se encontró [%s %s]"
		]);}
	public static function txtMsgXItemAlreadyExists(){ return Lemma::txt([__FUNCTION__
		,fr=>"Cet objet existe déjà: %s."
		,en=>"This object already exists: %s."
		,el=>"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		,de=>"Dieses Objekt existiert bereits."
		,es=>"Este objeto ya existe: %s."
		]);}

	public static function txtMsgCancelling(){ return Lemma::txt([__FUNCTION__
		,en=>"Cancelling..."
		,fr=>"Annulation..."
		,el=>"Ακύρωση..."
		,de=>"Wird abgebrochen ..."
		,es=>"Cancelando..."
		]);}
	public static function txtMsgProgressCancelled(){ return Lemma::txt([__FUNCTION__
		,en=>"The process has been cancelled."
		,fr=>"Le processus a été annulé."
		,el=>"Η διαδικασία ακυρώθηκε."
		,de=>"Der Vorgang wurde abgebrochen."
		,es=>"El proceso se ha cancelado."
		]);}
	public static function txtMsgProgressCompleted(){ return Lemma::txt([__FUNCTION__
		,en=>"The process is completed."
		,fr=>"Le processus est terminé."
		,el=>"Η διαδικασία ολοκληρώθηκε."
		,de=>"Der Vorgang ist abgeschlossen."
		,es=>"El proceso se ha completado."
		]);}
	public static function txtMsgNoObjectFound(){ return Lemma::txt([__FUNCTION__
		,en=>"No object found."
		,fr=>"Pas d'objet trouvé."
		,el=>"Δε βρέθηκε κανένα αντικείμενο."
		,de=>"Kein Objekt gefunden"
		,es=>"No se ha encontrado ningún objeto."
		]);}
	public static function txtMsgInvalidAction(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid action."
		,fr=>"Action invalide."
		,el=>"Εσφαλμένη εντολή."
		,de=>"Ungültige Aktion"
		,es=>"Acción no válida."
		]);}

	public static function txtMsgCannotConnectToLdapServer(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot connect to the database."
		,fr=>"Erreur à la connexion à la base de données."
		,el=>"Σφάλμα σύνδεσης με την βάση δεδομένων."
		,de=>"Es kann keine Verbindung zur Datenbank hergestellt werden."
		,es=>"No se puede conectar a la base de datos."
		]);}


	public static function txtMsgDevelopmentEnvironment(){ return Lemma::txt([__FUNCTION__
		,en=>"You are viewing this message because the application runs in DEVELOPMENT mode."
		,fr=>"Ce message s'affiche parce que l'application est en mode DEVELOPPEMENT."
		,el=>"Το μήνυμα αυτό εμφανίζεται γιατί η εφαρμογή τρέχει σε περιβάλλον ανάπτυξης."
		,de=>"Diese Meldung wird angezeigt, weil die Applikation im ENTWICKLUNGSMODUS läuft."
		,es=>"Está viendo este mensaje porque la aplicación se está ejecutando en modo DESARROLLO."
		]);}
	public static function txtMsgAnErrorOccurred(){ return Lemma::txt([__FUNCTION__
		,en=>"An unexpected server error has occurred."
		,fr=>"Il y avait une erreur inattendue."
		,el=>"Προέκυψε ένα σφάλμα στον διακομιστή."
		,de=>"Ein unerwarteter Serverfehler ist aufgetreten."
		,es=>"Ha habido un error inesperado en el servidor."
		]);}
	public static function txtMsgAnErrorOccurredAndTeamNotified(){ return Lemma::txt([__FUNCTION__
		,en=>"An unexpected server error has occurred. The support team has been notified."
		,fr=>"Il y avait une erreur inattendue. L'équipe de support vient d'en être notifié."
		,el=>"Προέκυψε ένα σφάλμα στον διακομιστή. Η ομάδα υποστήριξης ειδοποιήθηκε."
		,de=>"Ein unerwarteter Serverfehler ist aufgetreten und das Support-Team wurde benachrichtigt."
		,es=>"Ha habido un error inesperado en el servido. El equipo de ayuda ha sido avisado."
		]);}


	public static function txtMsgErrorWhileUploadingFile(){ return Lemma::txt([__FUNCTION__
		,en=>"An error occurred while uploading file."
		,fr=>"Erreur pendant l'envoi du fichier."
		,el=>"Σφάλμα κατά την αποστολή του αρχείου."
		,de=>"Beim Hochladen der Datei ist ein Fehler aufgetreten."
		,es=>"Error al cargar el archivo."
		]);}

	public static function txtMsgErrorWhileDownloadingFile(){ return Lemma::txt([__FUNCTION__
		,en=>"An error occurred while downloading file."
		,fr=>"Erreur pendant le téléchargement du fichier."
		,el=>"Σφάλμα κατά την λήψη του αρχείου."
		,de=>"Beim Herunterladen der Datei ist ein Fehler aufgetreten"
		,es=>"Error al descargar el archivo."
		]);}
	public static function txtMsgUnsavedChanges(){ return Lemma::txt([__FUNCTION__
		,en=>"There are unsaved changes."
		,fr=>"Il y a des changements qui ne sont pas sauvegardés."
		,el=>"Υπάρχουν μη αποθηκευμένες αλλαγές."
		,de=>"Es gibt ungespeicherte Änderungen"
		,es=>"Hay cambios no guardados."
		]);}



	public static function txtUnit_byte(){ return Lemma::txt([__FUNCTION__
		,en=>"B"
		,fr=>"o"
		,el=>"B"
		,de=>"B"
		,es=>"B"
		]);}
	public static function txtUnit_sec(){ return Lemma::txt([__FUNCTION__
		,en=>"sec"
		,fr=>"sec"
		,el=>"sec"
		,de=>"sec"
		,es=>"seg"
		]);}
	public static function txtUnit_day(){ return Lemma::txt([__FUNCTION__
		,en=>"d"
		,fr=>"j"
		,el=>"ημ"
		,de=>"t"
		,es=>"d"
		]);}
	public static function txtUnit_hour(){ return Lemma::txt([__FUNCTION__
		,en=>"h"
		,fr=>"h"
		,el=>"ώρ"
		,de=>"h"
		,es=>"h"
		]);}


	public static function txtLang_($x){ return static::txt(__FUNCTION__,$x); }
	public static function txtLang_en(){ return Lemma::txt([__FUNCTION__
		,en=>"English"
		,fr=>"Anglais"
		,el=>"Αγγλικά"
		,de=>"Englisch"
		,es=>"Inglés"
		]);}
	public static function txtLang_fr(){ return Lemma::txt([__FUNCTION__
		,en=>"French"
		,fr=>"Français"
		,el=>"Γαλλικά"
		,de=>"Französisch"
		,es=>"Francés"
		]);}
	public static function txtLang_el(){ return Lemma::txt([__FUNCTION__
		,en=>"Greek"
		,fr=>"Grec"
		,el=>"Ελληνικά"
		,de=>"Griechisch"
		,es=>"Griego"
		]);}
	public static function txtLang_ar(){ return Lemma::txt([__FUNCTION__
		,en=>"Arabic"
		,fr=>"Arabic"
		,de=>"Arabisch"
		,es=>"Árabe"
		]);}
	public static function txtLang_de(){ return Lemma::txt([__FUNCTION__
		,en=>"German"
		,fr=>"Allemand"
		,de=>"Deutsch"
		,es=>"Alemán"
		]);}
	public static function txtLang_es(){ return Lemma::txt([__FUNCTION__
		,en=>"Spanish"
		,fr=>"Espagnol"
		,de=>"Spanisch"
		,es=>"Español"
		]);}
	public static function txtLang_it(){ return Lemma::txt([__FUNCTION__
		,en=>"Italian"
		,fr=>"Italien"
		,de=>"Italienisch"
		,es=>"Italiano"
		]);}
	public static function txtLang_fi(){ return Lemma::txt([__FUNCTION__
		,en=>"Finnish"
		,fr=>"Finnois"
		,de=>"Finnisch"
		,es=>"Finlandés"
		]);}
	public static function txtLang_ja(){ return Lemma::txt([__FUNCTION__
		,en=>"Japanese"
		,fr=>"Japonais"
		,de=>"Japanisch"
		,es=>"Japonés"
		]);}
	public static function txtLang_ko(){ return Lemma::txt([__FUNCTION__
		,en=>"Korean"
		,fr=>"Coréen"
		,de=>"Koreanisch"
		,es=>"Coreano"
		]);}
	public static function txtLang_nl(){ return Lemma::txt([__FUNCTION__
		,en=>"Dutch"
		,fr=>"Néerlandais"
		,de=>"Niederländisch"
		,es=>"Holandés"
		]);}
	public static function txtLang_no(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian"
		,fr=>"Norvégien"
		,de=>"Norwegisch"
		,es=>"Noruego"
		]);}
	public static function txtLang_pl(){ return Lemma::txt([__FUNCTION__
		,en=>"Polish"
		,fr=>"Polonais"
		,de=>"Polnisch"
		,es=>"Polaco"
		]);}
	public static function txtLang_pt(){ return Lemma::txt([__FUNCTION__
		,en=>"Portuguese"
		,fr=>"Portugais"
		,de=>"Portugiesisch"
		,es=>"Portugués"
		]);}
	public static function txtLang_ru(){ return Lemma::txt([__FUNCTION__
		,en=>"Russian"
		,fr=>"Russe"
		,de=>"Russisch"
		,es=>"Ruso"
		]);}
	public static function txtLang_sv(){ return Lemma::txt([__FUNCTION__
		,en=>"Swedish"
		,fr=>"Suédois"
		,de=>"Schwedisch"
		,es=>"Sueco"
		]);}
	public static function txtLang_zh(){ return Lemma::txt([__FUNCTION__
		,en=>"Chinese"
		,fr=>"Chinois"
		,de=>"Chinesisch"
		,es=>"Chino"
		]);}

	public static function txtLang_ab(){ return Lemma::txt([__FUNCTION__
		,en=>"Abkhaz"
		,de=>"Abchasisch"
		,es=>"Abkhaz"
		]);}
	public static function txtLang_aa(){ return Lemma::txt([__FUNCTION__
		,en=>"Afar"
		,de=>"Afar"
		,es=>"Afar"
		]);}
	public static function txtLang_af(){ return Lemma::txt([__FUNCTION__
		,en=>"Afrikaans"
		,de=>"Afrikaans"
		,es=>"Afrikáans"
		]);}
	public static function txtLang_ak(){ return Lemma::txt([__FUNCTION__
		,en=>"Akan"
		,de=>"Akan"
		,es=>"Akan"
		]);}
	public static function txtLang_sq(){ return Lemma::txt([__FUNCTION__
		,en=>"Albanian"
		,de=>"Albanisch"
		,es=>"Albanés"
		]);}
	public static function txtLang_am(){ return Lemma::txt([__FUNCTION__
		,en=>"Amharic"
		,de=>"Amharisch"
		,es=>"Amhárico"
		]);}
	public static function txtLang_an(){ return Lemma::txt([__FUNCTION__
		,en=>"Aragonese"
		,de=>"Aragonisch"
		,es=>"Aragonés"
		]);}
	public static function txtLang_hy(){ return Lemma::txt([__FUNCTION__
		,en=>"Armenian"
		,de=>"Armenisch"
		,es=>"Armenio"
		]);}
	public static function txtLang_as(){ return Lemma::txt([__FUNCTION__
		,en=>"Assamese"
		,de=>"Assamesisch"
		,es=>"Asamés"
		]);}
	public static function txtLang_av(){ return Lemma::txt([__FUNCTION__
		,en=>"Avaric"
		,de=>"Awarisch"
		,es=>"Ávaro"
		]);}
	public static function txtLang_ae(){ return Lemma::txt([__FUNCTION__
		,en=>"Avestan"
		,de=>"Avestan"
		,es=>"Avéstico"
		]);}
	public static function txtLang_ay(){ return Lemma::txt([__FUNCTION__
		,en=>"Aymara"
		,de=>"Aymara"
		,es=>"Aymara"
		]);}
	public static function txtLang_az(){ return Lemma::txt([__FUNCTION__
		,en=>"Azerbaijani"
		,de=>"Aserbaidschanisch"
		,es=>"Azerí"
		]);}
	public static function txtLang_bm(){ return Lemma::txt([__FUNCTION__
		,en=>"Bambara"
		,de=>"Bambara"
		,es=>"Bambara"
		]);}
	public static function txtLang_ba(){ return Lemma::txt([__FUNCTION__
		,en=>"Bashkir"
		,de=>"Baschkirisch"
		,es=>"Baskir"
		]);}
	public static function txtLang_eu(){ return Lemma::txt([__FUNCTION__
		,en=>"Basque"
		,de=>"Baskisch"
		,es=>"Vasco"
		]);}
	public static function txtLang_be(){ return Lemma::txt([__FUNCTION__
		,en=>"Belarusian"
		,de=>"Belorussisch "
		,es=>"Bielorruso"
		]);}
	public static function txtLang_bn(){ return Lemma::txt([__FUNCTION__
		,en=>"Bengali"
		,de=>"Bengalisch"
		,es=>"Bengalí"
		]);}
	public static function txtLang_bh(){ return Lemma::txt([__FUNCTION__
		,en=>"Bihari"
		,de=>"Biharisch"
		,es=>"Bihari"
		]);}
	public static function txtLang_bi(){ return Lemma::txt([__FUNCTION__
		,en=>"Bislama"
		,de=>"Bislama"
		,es=>"Bislama"
		]);}
	public static function txtLang_bs(){ return Lemma::txt([__FUNCTION__
		,en=>"Bosnian"
		,de=>"Bosnisch"
		,es=>"Bosnio"
		]);}
	public static function txtLang_br(){ return Lemma::txt([__FUNCTION__
		,en=>"Breton"
		,de=>"Brettonisch"
		,es=>"Bretón"
		]);}
	public static function txtLang_bg(){ return Lemma::txt([__FUNCTION__
		,en=>"Bulgarian"
		,de=>"Bulgarisch"
		,es=>"Búlgaro"
		]);}
	public static function txtLang_my(){ return Lemma::txt([__FUNCTION__
		,en=>"Burmese"
		,de=>"Burmesisch"
		,es=>"Birmano"
		]);}
	public static function txtLang_ca(){ return Lemma::txt([__FUNCTION__
		,en=>"Catalan"
		,de=>"Katalanisch"
		,es=>"Catalán"
		]);}
	public static function txtLang_ch(){ return Lemma::txt([__FUNCTION__
		,en=>"Chamorro"
		,de=>"Chamorro"
		,es=>"Chamorro"
		]);}
	public static function txtLang_ce(){ return Lemma::txt([__FUNCTION__
		,en=>"Chechen"
		,de=>"Tschetschenisch"
		,es=>"Chechén"
		]);}
	public static function txtLang_ny(){ return Lemma::txt([__FUNCTION__
		,en=>"Chichewa"
		,de=>"Chichewa"
		,es=>"Chichewa"
		]);}
	public static function txtLang_cv(){ return Lemma::txt([__FUNCTION__
		,en=>"Chuvash"
		,de=>"Chuvash"
		,es=>"Chuvash"
		]);}
	public static function txtLang_kw(){ return Lemma::txt([__FUNCTION__
		,en=>"Cornish"
		,de=>"Kornisch"
		,es=>"Córnico"
		]);}
	public static function txtLang_co(){ return Lemma::txt([__FUNCTION__
		,en=>"Corsican"
		,de=>"Korsisch"
		,es=>"Corso"
		]);}
	public static function txtLang_cr(){ return Lemma::txt([__FUNCTION__
		,en=>"Cree"
		,de=>"Cree"
		,es=>"Cree"
		]);}
	public static function txtLang_hr(){ return Lemma::txt([__FUNCTION__
		,en=>"Croatian"
		,de=>"Kroatisch"
		,es=>"Croata"
		]);}
	public static function txtLang_cs(){ return Lemma::txt([__FUNCTION__
		,en=>"Czech"
		,de=>"Tschechisch"
		,es=>"Checo"
		]);}
	public static function txtLang_da(){ return Lemma::txt([__FUNCTION__
		,en=>"Danish"
		,de=>"Dänisch"
		,es=>"Danés"
		]);}
	public static function txtLang_dv(){ return Lemma::txt([__FUNCTION__
		,en=>"Divehi"
		,de=>"Divehi"
		,es=>"Dhivehi"
		]);}
	public static function txtLang_dz(){ return Lemma::txt([__FUNCTION__
		,en=>"Dzongkha"
		,de=>"Dzongkha"
		,es=>"Dzongkha"
		]);}
	public static function txtLang_eo(){ return Lemma::txt([__FUNCTION__
		,en=>"Esperanto"
		,de=>"Esperanto"
		,es=>"Esperanto"
		]);}
	public static function txtLang_et(){ return Lemma::txt([__FUNCTION__
		,en=>"Estonian"
		,de=>"Estonisch"
		,es=>"Estonio"
		]);}
	public static function txtLang_ee(){ return Lemma::txt([__FUNCTION__
		,en=>"Ewe"
		,de=>"Ewe"
		,es=>"Ewe"
		]);}
	public static function txtLang_fo(){ return Lemma::txt([__FUNCTION__
		,en=>"Faroese"
		,de=>"Färöisch "
		,es=>"Faroese"
		]);}
	public static function txtLang_fj(){ return Lemma::txt([__FUNCTION__
		,en=>"Fijian"
		,de=>"Fidschianisch"
		,es=>"Fiyi"
		]);}
	public static function txtLang_ff(){ return Lemma::txt([__FUNCTION__
		,en=>"Fula"
		,de=>"Fula"
		,es=>"Fula"
		]);}
	public static function txtLang_gl(){ return Lemma::txt([__FUNCTION__
		,en=>"Galician"
		,de=>"Galizisch"
		,es=>"Gallego"
		]);}
	public static function txtLang_ka(){ return Lemma::txt([__FUNCTION__
		,en=>"Georgian"
		,de=>"Georgisch"
		,es=>"Georgiano"
		]);}
	public static function txtLang_gn(){ return Lemma::txt([__FUNCTION__
		,en=>"Guaraní"
		,de=>"Guarani"
		,es=>"Guaraní"
		]);}
	public static function txtLang_gu(){ return Lemma::txt([__FUNCTION__
		,en=>"Gujarati"
		,de=>"Gujarati"
		,es=>"Gujarati"
		]);}
	public static function txtLang_ht(){ return Lemma::txt([__FUNCTION__
		,en=>"Haitian"
		,de=>"Haitianisch"
		,es=>"Haitiano"
		]);}
	public static function txtLang_ha(){ return Lemma::txt([__FUNCTION__
		,en=>"Hausa"
		,de=>"Hausa"
		,es=>"Hausa"
		]);}
	public static function txtLang_he(){ return Lemma::txt([__FUNCTION__
		,en=>"Hebrew"
		,de=>"Hebräisch"
		,es=>"Hebreo"
		]);}
	public static function txtLang_hz(){ return Lemma::txt([__FUNCTION__
		,en=>"Herero"
		,de=>"Herero"
		,es=>"Herero"
		]);}
	public static function txtLang_hi(){ return Lemma::txt([__FUNCTION__
		,en=>"Hindi"
		,de=>"Hindi"
		,es=>"Hindi"
		]);}
	public static function txtLang_ho(){ return Lemma::txt([__FUNCTION__
		,en=>"Hiri Motu"
		,de=>"Hiri Moru"
		,es=>"Hiri Motu"
		]);}
	public static function txtLang_hu(){ return Lemma::txt([__FUNCTION__
		,en=>"Hungarian"
		,de=>"Ungarisch"
		,es=>"Húngaro"
		]);}
	public static function txtLang_ia(){ return Lemma::txt([__FUNCTION__
		,en=>"Interlingua"
		,de=>"Interlingua"
		,es=>"Interlingua"
		]);}
	public static function txtLang_id(){ return Lemma::txt([__FUNCTION__
		,en=>"Indonesian"
		,de=>"Indonesisch"
		,es=>"Indonesio"
		]);}
	public static function txtLang_ie(){ return Lemma::txt([__FUNCTION__
		,en=>"Interlingue"
		,de=>"Interlingue"
		,es=>"Interlingua"
		]);}
	public static function txtLang_ga(){ return Lemma::txt([__FUNCTION__
		,en=>"Irish"
		,de=>"Irisch"
		,es=>"Irlandés"
		]);}
	public static function txtLang_ig(){ return Lemma::txt([__FUNCTION__
		,en=>"Igbo"
		,de=>"Igbo"
		,es=>"Igbo"
		]);}
	public static function txtLang_ik(){ return Lemma::txt([__FUNCTION__
		,en=>"Inupiaq"
		,de=>"Inupiaq"
		,es=>"Iñupiaq"
		]);}
	public static function txtLang_io(){ return Lemma::txt([__FUNCTION__
		,en=>"Ido"
		,de=>"Ido"
		,es=>"Ido"
		]);}
	public static function txtLang_is(){ return Lemma::txt([__FUNCTION__
		,en=>"Icelandic"
		,de=>"Isländisch"
		,es=>"Islandés"
		]);}
	public static function txtLang_iu(){ return Lemma::txt([__FUNCTION__
		,en=>"Inuktitut"
		,de=>"Inuktitut"
		,es=>"Inuktitut"
		]);}
	public static function txtLang_jv(){ return Lemma::txt([__FUNCTION__
		,en=>"Javanese"
		,de=>"Javanesisch"
		,es=>"Javanés"
		]);}
	public static function txtLang_kl(){ return Lemma::txt([__FUNCTION__
		,en=>"Kalaallisut"
		,de=>"Kalaallisut"
		,es=>"Kalaallisut"
		]);}
	public static function txtLang_kn(){ return Lemma::txt([__FUNCTION__
		,en=>"Kannada"
		,de=>"Kannada"
		,es=>"Canarés"
		]);}
	public static function txtLang_kr(){ return Lemma::txt([__FUNCTION__
		,en=>"Kanuri"
		,de=>"Kanuri"
		,es=>"Kanuri"
		]);}
	public static function txtLang_ks(){ return Lemma::txt([__FUNCTION__
		,en=>"Kashmiri"
		,de=>"Kaschmirisch"
		,es=>"Cachemir"
		]);}
	public static function txtLang_kk(){ return Lemma::txt([__FUNCTION__
		,en=>"Kazakh"
		,de=>"Kasachisch"
		,es=>"Kazakh"
		]);}
	public static function txtLang_km(){ return Lemma::txt([__FUNCTION__
		,en=>"Khmer"
		,de=>"Khmer"
		,es=>"Khmer"
		]);}
	public static function txtLang_ki(){ return Lemma::txt([__FUNCTION__
		,en=>"Kikuyu"
		,de=>"Kikuyu"
		,es=>"Kikuyu"
		]);}
	public static function txtLang_rw(){ return Lemma::txt([__FUNCTION__
		,en=>"Kinyarwanda"
		,de=>"Kinyarwanda"
		,es=>"Kinyarwanda"
		]);}
	public static function txtLang_ky(){ return Lemma::txt([__FUNCTION__
		,en=>"Kyrgyz"
		,de=>"Kirgisisch"
		,es=>"Kyrgyz"
		]);}
	public static function txtLang_kv(){ return Lemma::txt([__FUNCTION__
		,en=>"Komi"
		,de=>"Komi"
		,es=>"Komi"
		]);}
	public static function txtLang_kg(){ return Lemma::txt([__FUNCTION__
		,en=>"Kongo"
		,de=>"Kongolesisch"
		,es=>"Kongo"
		]);}
	public static function txtLang_ku(){ return Lemma::txt([__FUNCTION__
		,en=>"Kurdish"
		,de=>"Kurdisch"
		,es=>"Kurdo"
		]);}
	public static function txtLang_kj(){ return Lemma::txt([__FUNCTION__
		,en=>"Kwanyama"
		,de=>"Kwanyama"
		,es=>"Kwanyama"
		]);}
	public static function txtLang_la(){ return Lemma::txt([__FUNCTION__
		,en=>"Latin"
		,de=>"Lateinisch"
		,es=>"Latín"
		]);}
	public static function txtLang_lb(){ return Lemma::txt([__FUNCTION__
		,en=>"Luxembourgish"
		,de=>"Luxemburgisch"
		,es=>"Luxemburgués"
		]);}
	public static function txtLang_lg(){ return Lemma::txt([__FUNCTION__
		,en=>"Ganda"
		,de=>"Ganda"
		,es=>"Ganda"
		]);}
	public static function txtLang_li(){ return Lemma::txt([__FUNCTION__
		,en=>"Limburgish"
		,de=>"Limburgisch"
		,es=>"Limburgués"
		]);}
	public static function txtLang_ln(){ return Lemma::txt([__FUNCTION__
		,en=>"Lingala"
		,de=>"Lingala"
		,es=>"Lingala"
		]);}
	public static function txtLang_lo(){ return Lemma::txt([__FUNCTION__
		,en=>"Lao"
		,de=>"Laotisch"
		,es=>"Lao"
		]);}
	public static function txtLang_lt(){ return Lemma::txt([__FUNCTION__
		,en=>"Lithuanian"
		,de=>"Litauisch"
		,es=>"Lituano"
		]);}
	public static function txtLang_lu(){ return Lemma::txt([__FUNCTION__
		,en=>"Luba-Katanga"
		,de=>"Luba-Katanga"
		,es=>"Luba-Katanga"
		]);}
	public static function txtLang_lv(){ return Lemma::txt([__FUNCTION__
		,en=>"Latvian"
		,de=>"Lettisch"
		,es=>"Letón"
		]);}
	public static function txtLang_gv(){ return Lemma::txt([__FUNCTION__
		,en=>"Manx"
		,de=>"Manx"
		,es=>"Manx"
		]);}
	public static function txtLang_mk(){ return Lemma::txt([__FUNCTION__
		,en=>"Macedonian"
		,de=>"Mazedonisch"
		,es=>"Macedonio"
		]);}
	public static function txtLang_mg(){ return Lemma::txt([__FUNCTION__
		,en=>"Malagasy"
		,de=>"Madagassisch"
		,es=>"Malagasy"
		]);}
	public static function txtLang_ms(){ return Lemma::txt([__FUNCTION__
		,en=>"Malay"
		,de=>"Malaiisch"
		,es=>"Malayo"
		]);}
	public static function txtLang_ml(){ return Lemma::txt([__FUNCTION__
		,en=>"Malayalam"
		,de=>"Malayalam"
		,es=>"Malayalam"
		]);}
	public static function txtLang_mt(){ return Lemma::txt([__FUNCTION__
		,en=>"Maltese"
		,de=>"Maltesisch"
		,es=>"Maltés"
		]);}
	public static function txtLang_mi(){ return Lemma::txt([__FUNCTION__
		,en=>"Māori"
		,de=>"Māori"
		,es=>"Maorí"
		]);}
	public static function txtLang_mr(){ return Lemma::txt([__FUNCTION__
		,en=>"Marathi"
		,de=>"Marathi"
		,es=>"Marathi"
		]);}
	public static function txtLang_mh(){ return Lemma::txt([__FUNCTION__
		,en=>"Marshallese"
		,de=>"Marshallisch"
		,es=>"Marshalés"
		]);}
	public static function txtLang_mn(){ return Lemma::txt([__FUNCTION__
		,en=>"Mongolian"
		,de=>"Mongolisch"
		,es=>"Mongol"
		]);}
	public static function txtLang_na(){ return Lemma::txt([__FUNCTION__
		,en=>"Nauru"
		,de=>"Nauruisch"
		,es=>"Nauru"
		]);}
	public static function txtLang_nv(){ return Lemma::txt([__FUNCTION__
		,en=>"Navajo"
		,de=>"Navajo"
		,es=>"Navajo"
		]);}
	public static function txtLang_nb(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian Bokmål"
		,de=>"Norwegisch Bokmål "
		,es=>"Noruego Bokmål"
		]);}
	public static function txtLang_nd(){ return Lemma::txt([__FUNCTION__
		,en=>"North Ndebele"
		,de=>"Nord Ndebele"
		,es=>"Ndebele septentrional"
		]);}
	public static function txtLang_ne(){ return Lemma::txt([__FUNCTION__
		,en=>"Nepali"
		,de=>"Nepalesisch"
		,es=>"Nepalí"
		]);}
	public static function txtLang_ng(){ return Lemma::txt([__FUNCTION__
		,en=>"Ndonga"
		,de=>"Ndonga"
		,es=>"Ndonga"
		]);}
	public static function txtLang_nn(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian Nynorsk"
		,de=>"Norwegisch Nynorsk"
		,es=>"Noruego Nynorsk"
		]);}
	public static function txtLang_ii(){ return Lemma::txt([__FUNCTION__
		,en=>"Nuosu"
		,de=>"Nuosu"
		,es=>"Nuosu"
		]);}
	public static function txtLang_nr(){ return Lemma::txt([__FUNCTION__
		,en=>"South Ndebele"
		,de=>"Süd Ndebele"
		,es=>"Ndebele meridional"
		]);}
	public static function txtLang_oc(){ return Lemma::txt([__FUNCTION__
		,en=>"Occitan"
		,de=>"Okzitanisch"
		,es=>"Occitano"
		]);}
	public static function txtLang_oj(){ return Lemma::txt([__FUNCTION__
		,en=>"Ojibwe"
		,de=>"Ojibwe"
		,es=>"Ojibwa"
		]);}
	public static function txtLang_cu(){ return Lemma::txt([__FUNCTION__
		,en=>"Old Slavonic"
		,de=>"Alt-Slowenisch"
		,es=>"Eslavo Antiguo"
		]);}
	public static function txtLang_om(){ return Lemma::txt([__FUNCTION__
		,en=>"Oromo"
		,de=>"Oromo"
		,es=>"Oromo"
		]);}
	public static function txtLang_or(){ return Lemma::txt([__FUNCTION__
		,en=>"Oriya"
		,de=>"Oriya"
		,es=>"Oriya"
		]);}
	public static function txtLang_os(){ return Lemma::txt([__FUNCTION__
		,en=>"Ossetian"
		,de=>"Ossetisch"
		,es=>"Osetio"
		]);}
	public static function txtLang_pa(){ return Lemma::txt([__FUNCTION__
		,en=>"Panjabi"
		,de=>"Panjabi"
		,es=>"Panyabí"
		]);}
	public static function txtLang_pi(){ return Lemma::txt([__FUNCTION__
		,en=>"Pāli"
		,de=>"Pāli"
		,es=>"Pāli"
		]);}
	public static function txtLang_fa(){ return Lemma::txt([__FUNCTION__
		,en=>"Farsi"
		,de=>"Farsi"
		,es=>"Persa"
		]);}
	public static function txtLang_ps(){ return Lemma::txt([__FUNCTION__
		,en=>"Pashto"
		,de=>"Pashto"
		,es=>"Pastún"
		]);}
	public static function txtLang_qu(){ return Lemma::txt([__FUNCTION__
		,en=>"Quechua"
		,de=>"Quechua"
		,es=>"Quechua"
		]);}
	public static function txtLang_rm(){ return Lemma::txt([__FUNCTION__
		,en=>"Romansh"
		,de=>"Rätoromanisch"
		,es=>"Romanche"
		]);}
	public static function txtLang_rn(){ return Lemma::txt([__FUNCTION__
		,en=>"Kirundi"
		,de=>"Kirundi"
		,es=>"Kirundi"
		]);}
	public static function txtLang_ro(){ return Lemma::txt([__FUNCTION__
		,en=>"Romanian"
		,de=>"Rumänisch"
		,es=>"Rumano"
		]);}
	public static function txtLang_sa(){ return Lemma::txt([__FUNCTION__
		,en=>"Sanskrit"
		,de=>"Sanskrit"
		,es=>"Sánscrito"
		]);}
	public static function txtLang_sc(){ return Lemma::txt([__FUNCTION__
		,en=>"Sardinian"
		,de=>"Sardisch"
		,es=>"Sardo"
		]);}
	public static function txtLang_sd(){ return Lemma::txt([__FUNCTION__
		,en=>"Sindhi"
		,de=>"Sindhi"
		,es=>"Sindhi"
		]);}
	public static function txtLang_se(){ return Lemma::txt([__FUNCTION__
		,en=>"Northern Sami"
		,de=>"Nordsamisch"
		,es=>"Sami septentrional"
		]);}
	public static function txtLang_sm(){ return Lemma::txt([__FUNCTION__
		,en=>"Samoan"
		,de=>"Samoanisch"
		,es=>"Samoano"
		]);}
	public static function txtLang_sg(){ return Lemma::txt([__FUNCTION__
		,en=>"Sango"
		,de=>"Sango"
		,es=>"Sango"
		]);}
	public static function txtLang_sr(){ return Lemma::txt([__FUNCTION__
		,en=>"Serbian"
		,de=>"Serbisch"
		,es=>"Serbio"
		]);}
	public static function txtLang_gd(){ return Lemma::txt([__FUNCTION__
		,en=>"Scottish Gaelic"
		,de=>"Schottisch-Gälisch "
		,es=>"Gaélico escocés"
		]);}
	public static function txtLang_sn(){ return Lemma::txt([__FUNCTION__
		,en=>"Shona"
		,de=>"Shona"
		,es=>"Shona"
		]);}
	public static function txtLang_si(){ return Lemma::txt([__FUNCTION__
		,en=>"Sinhala"
		,de=>"Sinhala"
		,es=>"Cingalés"
		]);}
	public static function txtLang_sk(){ return Lemma::txt([__FUNCTION__
		,en=>"Slovak"
		,de=>"Slowakisch"
		,es=>"Eslovaco"
		]);}
	public static function txtLang_sl(){ return Lemma::txt([__FUNCTION__
		,en=>"Slovene"
		,de=>"Slowenisch"
		,es=>"Esloveno"
		]);}
	public static function txtLang_so(){ return Lemma::txt([__FUNCTION__
		,en=>"Somali"
		,de=>"Somalisch"
		,es=>"Somalí"
		]);}
	public static function txtLang_st(){ return Lemma::txt([__FUNCTION__
		,en=>"Southern Sotho"
		,de=>"Süd-Sotho"
		,es=>"Sesotho"
		]);}
	public static function txtLang_su(){ return Lemma::txt([__FUNCTION__
		,en=>"Sundanese"
		,de=>"Sudanesisch"
		,es=>"Sondanés"
		]);}
	public static function txtLang_sw(){ return Lemma::txt([__FUNCTION__
		,en=>"Swahili"
		,de=>"Swahili"
		,es=>"Suahili"
		]);}
	public static function txtLang_ss(){ return Lemma::txt([__FUNCTION__
		,en=>"Swati"
		,de=>"Swati"
		,es=>"Suazi"
		]);}
	public static function txtLang_ta(){ return Lemma::txt([__FUNCTION__
		,en=>"Tamil"
		,de=>"Tamil"
		,es=>"Tamil"
		]);}
	public static function txtLang_te(){ return Lemma::txt([__FUNCTION__
		,en=>"Telugu"
		,de=>"Telugu"
		,es=>"Telugu"
		]);}
	public static function txtLang_tg(){ return Lemma::txt([__FUNCTION__
		,en=>"Tajik"
		,de=>"Tadschikisch "
		,es=>"Tajik"
		]);}
	public static function txtLang_th(){ return Lemma::txt([__FUNCTION__
		,en=>"Thai"
		,de=>"Thailändisch"
		,es=>"Tailandés"
		]);}
	public static function txtLang_ti(){ return Lemma::txt([__FUNCTION__
		,en=>"Tigrinya"
		,de=>"Tigrinya"
		,es=>"Tigriña"
		]);}
	public static function txtLang_bo(){ return Lemma::txt([__FUNCTION__
		,en=>"Tibetan"
		,de=>"Tibetisch"
		,es=>"Tibetano"
		]);}
	public static function txtLang_tk(){ return Lemma::txt([__FUNCTION__
		,en=>"Turkmen"
		,de=>"Turkmenisch"
		,es=>"Turcomano"
		]);}
	public static function txtLang_tl(){ return Lemma::txt([__FUNCTION__
		,en=>"Tagalog"
		,de=>"Tagalong"
		,es=>"Tagalo"
		]);}
	public static function txtLang_tn(){ return Lemma::txt([__FUNCTION__
		,en=>"Tswana"
		,de=>"Tswana"
		,es=>"Tswana"
		]);}
	public static function txtLang_to(){ return Lemma::txt([__FUNCTION__
		,en=>"Tonga"
		,de=>"Tongalesisch"
		,es=>"Tonga"
		]);}
	public static function txtLang_tr(){ return Lemma::txt([__FUNCTION__
		,en=>"Turkish"
		,de=>"Türkisch"
		,es=>"Turco"
		]);}
	public static function txtLang_ts(){ return Lemma::txt([__FUNCTION__
		,en=>"Tsonga"
		,de=>"Tsonga"
		,es=>"Tsonga"
		]);}
	public static function txtLang_tt(){ return Lemma::txt([__FUNCTION__
		,en=>"Tatar"
		,de=>"Tatarisch"
		,es=>"Tártaro"
		]);}
	public static function txtLang_tw(){ return Lemma::txt([__FUNCTION__
		,en=>"Twi"
		,de=>"Twi"
		,es=>"Twi"
		]);}
	public static function txtLang_ty(){ return Lemma::txt([__FUNCTION__
		,en=>"Tahitian"
		,de=>"Tahitisch"
		,es=>"Tahitiano"
		]);}
	public static function txtLang_ug(){ return Lemma::txt([__FUNCTION__
		,en=>"Uyghur"
		,de=>" Uighurisch"
		,es=>"Iugur"
		]);}
	public static function txtLang_uk(){ return Lemma::txt([__FUNCTION__
		,en=>"Ukrainian"
		,de=>"Ukrainisch"
		,es=>"Ucraniano"
		]);}
	public static function txtLang_ur(){ return Lemma::txt([__FUNCTION__
		,en=>"Urdu"
		,de=>"Urdu"
		,es=>"Urdu"
		]);}
	public static function txtLang_uz(){ return Lemma::txt([__FUNCTION__
		,en=>"Uzbek"
		,de=>"Usbekisch"
		,es=>"Uzbeko"
		]);}
	public static function txtLang_ve(){ return Lemma::txt([__FUNCTION__
		,en=>"Venda"
		,de=>"Venda"
		,es=>"Venda"
		]);}
	public static function txtLang_vi(){ return Lemma::txt([__FUNCTION__
		,en=>"Vietnamese"
		,de=>" Vietnamesisch"
		,es=>"Vietnamita"
		]);}
	public static function txtLang_vo(){ return Lemma::txt([__FUNCTION__
		,en=>"Volapük"
		,de=>"Volapük"
		,es=>"Volapük"
		]);}
	public static function txtLang_wa(){ return Lemma::txt([__FUNCTION__
		,en=>"Walloon"
		,de=>"Wallonisch"
		,es=>"Valón"
		]);}
	public static function txtLang_cy(){ return Lemma::txt([__FUNCTION__
		,en=>"Welsh"
		,de=>"Walisisch"
		,es=>"Galés"
		]);}
	public static function txtLang_wo(){ return Lemma::txt([__FUNCTION__
		,en=>"Wolof"
		,de=>"Wolof"
		,es=>"Wolof"
		]);}
	public static function txtLang_fy(){ return Lemma::txt([__FUNCTION__
		,en=>"Western Frisian"
		,de=>"Westfriesisch"
		,es=>"Frisón occidental"
		]);}
	public static function txtLang_xh(){ return Lemma::txt([__FUNCTION__
		,en=>"Xhosa"
		,de=>"Xhosa"
		,es=>"Xhosa"
		]);}
	public static function txtLang_yi(){ return Lemma::txt([__FUNCTION__
		,en=>"Yiddish"
		,de=>"Jiddisch"
		,es=>"Yidis"
		]);}
	public static function txtLang_yo(){ return Lemma::txt([__FUNCTION__
		,en=>"Yoruba"
		,de=>"Yoruba"
		,es=>"Yoruba"
		]);}
	public static function txtLang_za(){ return Lemma::txt([__FUNCTION__
		,en=>"Zhuang"
		,de=>"Zhuang"
		,es=>"Zhuang"
		]);}
	public static function txtLang_zu(){ return Lemma::txt([__FUNCTION__
		,en=>"Zulu"
		,de=>"Zulu"
		,es=>"Zulú"
		]);}



	public static function txtCountry_($x) { return static::txt(__FUNCTION__,$x); }
	public static function txtCountry_AD(){ return Lemma::txt([__FUNCTION__
		,en=>"ANDORRA"
		,fr=>"ANDORRE"
		,de=>"ANDORRA"
		,es=>"ANDORRA"
		]);}
	public static function txtCountry_AE(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED ARAB EMIRATES"
		,fr=>"ÉMIRATS ARABES UNIS"
		,de=>"VEREINIGTE ARABISCHE EMIRATE"
		,es=>"EMIRATOS ÁRABES UNIDOS"
		]);}
	public static function txtCountry_AF(){ return Lemma::txt([__FUNCTION__
		,en=>"AFGHANISTAN"
		,fr=>"AFGHANISTAN"
		,de=>"AFGHANISTAN"
		,es=>"AFGANISTÁN"
		]);}
	public static function txtCountry_AG(){ return Lemma::txt([__FUNCTION__
		,en=>"ANTIGUA AND BARBUDA"
		,fr=>"ANTIGUA-ET-BARBUDA"
		,de=>"ANTIGUA UND BARBUDA"
		,es=>"ANTIGUA Y BARBUDA"
		]);}
	public static function txtCountry_AI(){ return Lemma::txt([__FUNCTION__
		,en=>"ANGUILLA"
		,fr=>"ANGUILLA"
		,de=>"ANGUILLA"
		,es=>"ANGUILA"
		]);}
	public static function txtCountry_AL(){ return Lemma::txt([__FUNCTION__
		,en=>"ALBANIA"
		,fr=>"ALBANIE"
		,de=>"ALBANIEN"
		,es=>"ALBANIA"
		]);}
	public static function txtCountry_AM(){ return Lemma::txt([__FUNCTION__
		,en=>"ARMENIA"
		,fr=>"ARMÉNIE"
		,de=>"ARMENIEN"
		,es=>"ARMENIA"
		]);}
	public static function txtCountry_AO(){ return Lemma::txt([__FUNCTION__
		,en=>"ANGOLA"
		,fr=>"ANGOLA"
		,de=>"ANGOLA"
		,es=>"ANGOLA"
		]);}
	public static function txtCountry_AQ(){ return Lemma::txt([__FUNCTION__
		,en=>"ANTARCTICA"
		,fr=>"ANTARCTIQUE"
		,de=>"ANTARKTIK"
		,es=>"ANTÁRTIDA"
		]);}
	public static function txtCountry_AR(){ return Lemma::txt([__FUNCTION__
		,en=>"ARGENTINA"
		,fr=>"ARGENTINE"
		,de=>"ARGENTINIEN"
		,es=>"ARGENTINA"
		]);}
	public static function txtCountry_AS(){ return Lemma::txt([__FUNCTION__
		,en=>"AMERICAN SAMOA"
		,fr=>"SAMOA AMÉRICAINES"
		,de=>"AMERIKANISCH SAMOA"
		,es=>"SAMOA AMERICANA"
		]);}
	public static function txtCountry_AT(){ return Lemma::txt([__FUNCTION__
		,en=>"AUSTRIA"
		,fr=>"AUTRICHE"
		,de=>"ÖSTERREICH"
		,es=>"AUSTRIA"
		]);}
	public static function txtCountry_AU(){ return Lemma::txt([__FUNCTION__
		,en=>"AUSTRALIA"
		,fr=>"AUSTRALIE"
		,de=>"AUSTRALIE"
		,es=>"AUSTRALIA"
		]);}
	public static function txtCountry_AW(){ return Lemma::txt([__FUNCTION__
		,en=>"ARUBA"
		,fr=>"ARUBA"
		,de=>"ARUBA"
		,es=>"ARUBA"
		]);}
	public static function txtCountry_AX(){ return Lemma::txt([__FUNCTION__
		,en=>"ÅLAND ISLANDS"
		,fr=>"ÅLAND, ÎLES"
		,de=>"ALAND-INSELN"
		,es=>"ÅLAND, ISLAS"
		]);}
	public static function txtCountry_AZ(){ return Lemma::txt([__FUNCTION__
		,en=>"AZERBAIJAN"
		,fr=>"AZERBAÏDJAN"
		,de=>"ASERBEIDSCHAN"
		,es=>"AZERBAIYÁN"
		]);}
	public static function txtCountry_BA(){ return Lemma::txt([__FUNCTION__
		,en=>"BOSNIA AND HERZEGOVINA"
		,fr=>"BOSNIE-HERZÉGOVINE"
		,de=>"BOSNIEN HERZEGOVINA"
		,es=>"BOSNIA-HERZEGOVINA"
		]);}
	public static function txtCountry_BB(){ return Lemma::txt([__FUNCTION__
		,en=>"BARBADOS"
		,fr=>"BARBADE"
		,de=>"BARBADOS"
		,es=>"BARBADOS"
		]);}
	public static function txtCountry_BD(){ return Lemma::txt([__FUNCTION__
		,en=>"BANGLADESH"
		,fr=>"BANGLADESH"
		,de=>"BANGLADESH"
		,es=>"BANGLADÉS"
		]);}
	public static function txtCountry_BE(){ return Lemma::txt([__FUNCTION__
		,en=>"BELGIUM"
		,fr=>"BELGIQUE"
		,de=>"BELGIEN"
		,es=>"BÉLGICA"
		]);}
	public static function txtCountry_BF(){ return Lemma::txt([__FUNCTION__
		,en=>"BURKINA FASO"
		,fr=>"BURKINA FASO"
		,de=>"BURKINA FASO"
		,es=>"BURKINA FASO"
		]);}
	public static function txtCountry_BG(){ return Lemma::txt([__FUNCTION__
		,en=>"BULGARIA"
		,fr=>"BULGARIE"
		,de=>"BULGARIEN"
		,es=>"BULGARIA"
		]);}
	public static function txtCountry_BH(){ return Lemma::txt([__FUNCTION__
		,en=>"BAHRAIN"
		,fr=>"BAHREÏN"
		,de=>"BAHREIN"
		,es=>"BARÉIN"
		]);}
	public static function txtCountry_BI(){ return Lemma::txt([__FUNCTION__
		,en=>"BURUNDI"
		,fr=>"BURUNDI"
		,de=>"BURUNDI"
		,es=>"BURUNDI"
		]);}
	public static function txtCountry_BJ(){ return Lemma::txt([__FUNCTION__
		,en=>"BENIN"
		,fr=>"BÉNIN"
		,de=>"BENIN"
		,es=>"BENÍN"
		]);}
	public static function txtCountry_BL(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT BARTHÉLEMY"
		,fr=>"SAINT-BARTHÉLEMY"
		,de=>"SAINT BARTHÉLEMY"
		,es=>"SAN BARTOLOMÉ"
		]);}
	public static function txtCountry_BM(){ return Lemma::txt([__FUNCTION__
		,en=>"BERMUDA"
		,fr=>"BERMUDES"
		,de=>"BERMUDA"
		,es=>"BERMUDAS"
		]);}
	public static function txtCountry_BN(){ return Lemma::txt([__FUNCTION__
		,en=>"BRUNEI DARUSSALAM"
		,fr=>"BRUNÉI DARUSSALAM"
		,de=>"BRUNEI DARUSSALAM"
		,es=>"BRUNÉIS DARUSSALAM"
		]);}
	public static function txtCountry_BO(){ return Lemma::txt([__FUNCTION__
		,en=>"BOLIVIA, PLURINATIONAL STATE OF"
		,fr=>"BOLIVIE, L'ÉTAT PLURINATIONAL DE"
		,de=>"BOLIVIEN, PLURINATIONALER STAAT"
		,es=>"BOLIVIA, ESTADO PLURINACIONAL DE"
		]);}
	public static function txtCountry_BQ(){ return Lemma::txt([__FUNCTION__
		,en=>"BONAIRE, SAINT EUSTATIUS AND SABA"
		,fr=>"BONAIRE, SAINT-EUSTACHE ET SABA"
		,de=>"BONAIRE, SAINT EUSTATIUS UND SABA"
		,es=>"BONAIRE, SAN EUSTAQUIO Y SABA"
		]);}
	public static function txtCountry_BR(){ return Lemma::txt([__FUNCTION__
		,en=>"BRAZIL"
		,fr=>"BRÉSIL"
		,de=>"BRASILIEN"
		,es=>"BRASIL"
		]);}
	public static function txtCountry_BS(){ return Lemma::txt([__FUNCTION__
		,en=>"BAHAMAS"
		,fr=>"BAHAMAS"
		,de=>"BAHAMAS"
		,es=>"BAHAMAS"
		]);}
	public static function txtCountry_BT(){ return Lemma::txt([__FUNCTION__
		,en=>"BHUTAN"
		,fr=>"BHOUTAN"
		,de=>"BHUTAN"
		,es=>"BUTÁN"
		]);}
	public static function txtCountry_BV(){ return Lemma::txt([__FUNCTION__
		,en=>"BOUVET ISLAND"
		,fr=>"BOUVET, ÎLE"
		,de=>"BOUVET-INSEL"
		,es=>"BOUVET, ISLA"
		]);}
	public static function txtCountry_BW(){ return Lemma::txt([__FUNCTION__
		,en=>"BOTSWANA"
		,fr=>"BOTSWANA"
		,de=>"BOTSWANA"
		,es=>"BOTSUANA"
		]);}
	public static function txtCountry_BY(){ return Lemma::txt([__FUNCTION__
		,en=>"BELARUS"
		,fr=>"BÉLARUS"
		,de=>"BELARUS"
		,es=>"BIELORRUSIA"
		]);}
	public static function txtCountry_BZ(){ return Lemma::txt([__FUNCTION__
		,en=>"BELIZE"
		,fr=>"BELIZE"
		,de=>"BELIZE"
		,es=>"BELICE"
		]);}
	public static function txtCountry_CA(){ return Lemma::txt([__FUNCTION__
		,en=>"CANADA"
		,fr=>"CANADA"
		,de=>"KANADA"
		,es=>"CANADÁ"
		]);}
	public static function txtCountry_CC(){ return Lemma::txt([__FUNCTION__
		,en=>"COCOS (KEELING) ISLANDS"
		,fr=>"COCOS (KEELING), ÎLES"
		,de=>"COCOS (KEELING) INSELN"
		,es=>"COCOS (KEELING), ISLAS"
		]);}
	public static function txtCountry_CD(){ return Lemma::txt([__FUNCTION__
		,en=>"CONGO, THE DEMOCRATIC REPUBLIC OF THE"
		,fr=>"CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU"
		,de=>"KONGO, DEMOKRATISCHE REPUBLIK"
		,es=>"CONGO, REPÚBLICA DEMOCRÁTICA DEL"
		]);}
	public static function txtCountry_CF(){ return Lemma::txt([__FUNCTION__
		,en=>"CENTRAL AFRICAN REPUBLIC"
		,fr=>"CENTRAFRICAINE, RÉPUBLIQUE"
		,de=>"ZENTRALAFRIKANISCHE REPUBLIK"
		,es=>"CENTROAFRICANA, REPÚBLICA"
		]);}
	public static function txtCountry_CG(){ return Lemma::txt([__FUNCTION__
		,en=>"CONGO"
		,fr=>"CONGO"
		,de=>"KONGO"
		,es=>"CONGO"
		]);}
	public static function txtCountry_CH(){ return Lemma::txt([__FUNCTION__
		,en=>"SWITZERLAND"
		,fr=>"SUISSE"
		,de=>"SCHWEIZ"
		,es=>"SUIZA"
		]);}
	public static function txtCountry_CI(){ return Lemma::txt([__FUNCTION__
		,en=>"CÔTE D'IVOIRE"
		,fr=>"CÔTE D'IVOIRE"
		,de=>"ELFENBEINKÜSTE"
		,es=>"COSTA DE MARFIL"
		]);}
	public static function txtCountry_CK(){ return Lemma::txt([__FUNCTION__
		,en=>"COOK ISLANDS"
		,fr=>"COOK, ÎLES"
		,de=>"COOK-INSELN"
		,es=>"COOK, ISLAS"
		]);}
	public static function txtCountry_CL(){ return Lemma::txt([__FUNCTION__
		,en=>"CHILE"
		,fr=>"CHILI"
		,de=>"CHILE"
		,es=>"CHILE"
		]);}
	public static function txtCountry_CM(){ return Lemma::txt([__FUNCTION__
		,en=>"CAMEROON"
		,fr=>"CAMEROUN"
		,de=>"KAMERUN"
		,es=>"CAMERÚN"
		]);}
	public static function txtCountry_CN(){ return Lemma::txt([__FUNCTION__
		,en=>"CHINA"
		,fr=>"CHINE"
		,de=>"CHINA"
		,es=>"CHINA"
		]);}
	public static function txtCountry_CO(){ return Lemma::txt([__FUNCTION__
		,en=>"COLOMBIA"
		,fr=>"COLOMBIE"
		,de=>"KOLUMBIEN"
		,es=>"COLOMBIA"
		]);}
	public static function txtCountry_CR(){ return Lemma::txt([__FUNCTION__
		,en=>"COSTA RICA"
		,fr=>"COSTA RICA"
		,de=>"COSTA RICA"
		,es=>"COSTA RICA"
		]);}
	public static function txtCountry_CU(){ return Lemma::txt([__FUNCTION__
		,en=>"CUBA"
		,fr=>"CUBA"
		,de=>"KUBA"
		,es=>"CUBA"
		]);}
	public static function txtCountry_CV(){ return Lemma::txt([__FUNCTION__
		,en=>"CAPE VERDE"
		,fr=>"CAP-VERT"
		,de=>"KAP VERDE"
		,es=>"CABO VERDE"
		]);}
	public static function txtCountry_CW(){ return Lemma::txt([__FUNCTION__
		,en=>"CURAÇAO"
		,fr=>"CURAÇAO"
		,de=>"CURAÇAO"
		,es=>"CURASAO"
		]);}
	public static function txtCountry_CX(){ return Lemma::txt([__FUNCTION__
		,en=>"CHRISTMAS ISLAND"
		,fr=>"CHRISTMAS, ÎLE"
		,de=>"WEIHNACHTSINSEL"
		,es=>"CHRISTMAS, ISLA"
		]);}
	public static function txtCountry_CY(){ return Lemma::txt([__FUNCTION__
		,en=>"CYPRUS"
		,fr=>"CHYPRE"
		,de=>"ZYPERN"
		,es=>"CHIPRE"
		]);}
	public static function txtCountry_CZ(){ return Lemma::txt([__FUNCTION__
		,en=>"CZECH REPUBLIC"
		,fr=>"TCHÈQUE, RÉPUBLIQUE"
		,de=>"TSCHECHISCHE REPUBLIK"
		,es=>"CHECA, REÚBLICA"
		]);}
	public static function txtCountry_DE(){ return Lemma::txt([__FUNCTION__
		,en=>"GERMANY"
		,fr=>"ALLEMAGNE"
		,de=>"DEUTSCHLAND"
		,es=>"ALEMANIA"
		]);}
	public static function txtCountry_DJ(){ return Lemma::txt([__FUNCTION__
		,en=>"DJIBOUTI"
		,fr=>"DJIBOUTI"
		,de=>"DSCHIBUTI"
		,es=>"DJIBOUTI"
		]);}
	public static function txtCountry_DK(){ return Lemma::txt([__FUNCTION__
		,en=>"DENMARK"
		,fr=>"DANEMARK"
		,de=>"DÄNEMARK"
		,es=>"DINAMARCA"
		]);}
	public static function txtCountry_DM(){ return Lemma::txt([__FUNCTION__
		,en=>"DOMINICA"
		,fr=>"DOMINIQUE"
		,de=>"DOMINICA"
		,es=>"DOMINICA"
		]);}
	public static function txtCountry_DO(){ return Lemma::txt([__FUNCTION__
		,en=>"DOMINICAN REPUBLIC"
		,fr=>"DOMINICAINE, RÉPUBLIQUE"
		,de=>"DOMINIKANISCHE REPUBLIK"
		,es=>"DOMINICANA, REPÚBLICA"
		]);}
	public static function txtCountry_DZ(){ return Lemma::txt([__FUNCTION__
		,en=>"ALGERIA"
		,fr=>"ALGÉRIE"
		,de=>"ALGERIEN"
		,es=>"ARGELIA"
		]);}
	public static function txtCountry_EC(){ return Lemma::txt([__FUNCTION__
		,en=>"ECUADOR"
		,fr=>"ÉQUATEUR"
		,de=>"ECUADOR"
		,es=>"ECUADOR"
		]);}
	public static function txtCountry_EE(){ return Lemma::txt([__FUNCTION__
		,en=>"ESTONIA"
		,fr=>"ESTONIE"
		,de=>"ESTONIEN"
		,es=>"ESTONIA"
		]);}
	public static function txtCountry_EG(){ return Lemma::txt([__FUNCTION__
		,en=>"EGYPT"
		,fr=>"ÉGYPTE"
		,de=>"ÄGYPTEN"
		,es=>"EGIPTO"
		]);}
	public static function txtCountry_EH(){ return Lemma::txt([__FUNCTION__
		,en=>"WESTERN SAHARA"
		,fr=>"SAHARA OCCIDENTAL"
		,de=>"WESTSAHARA"
		,es=>"SÁHARA OCCIDENTAL"
		]);}
	public static function txtCountry_ER(){ return Lemma::txt([__FUNCTION__
		,en=>"ERITREA"
		,fr=>"ÉRYTHRÉE"
		,de=>"ERITREA"
		,es=>"ERITREA"
		]);}
	public static function txtCountry_ES(){ return Lemma::txt([__FUNCTION__
		,en=>"SPAIN"
		,fr=>"ESPAGNE"
		,de=>"SPANIEN"
		,es=>"ESPAÑA"
		]);}
	public static function txtCountry_ET(){ return Lemma::txt([__FUNCTION__
		,en=>"ETHIOPIA"
		,fr=>"ÉTHIOPIE"
		,de=>"ÄTHIOPIEN"
		,es=>"ETIOPÍA"
		]);}
	public static function txtCountry_FI(){ return Lemma::txt([__FUNCTION__
		,en=>"FINLAND"
		,fr=>"FINLANDE"
		,de=>"FINNLAND"
		,es=>"FINLANDIA"
		]);}
	public static function txtCountry_FJ(){ return Lemma::txt([__FUNCTION__
		,en=>"FIJI"
		,fr=>"FIDJI"
		,de=>"FIDJI"
		,es=>"FIYI"
		]);}
	public static function txtCountry_FK(){ return Lemma::txt([__FUNCTION__
		,en=>"FALKLAND ISLANDS (MALVINAS)"
		,fr=>"FALKLAND, ÎLES (MALVINAS)"
		,de=>"FALKLANDINSELN (MALVINAS)"
		,es=>"FALKLAND, ISLAS (MALVINAS)"
		]);}
	public static function txtCountry_FM(){ return Lemma::txt([__FUNCTION__
		,en=>"MICRONESIA, FEDERATED STATES OF"
		,fr=>"MICRONÉSIE, ÉTATS FÉDÉRÉS DE"
		,de=>"MIKRONESIEN, FÖDERIERTE STAATEN VON "
		,es=>"MICRONESIA, ESTADOS FEDERADOS DE"
		]);}
	public static function txtCountry_FO(){ return Lemma::txt([__FUNCTION__
		,en=>"FAROE ISLANDS"
		,fr=>"FÉROÉ, ÎLES"
		,de=>"Färöer"
		,es=>"FEROE, ISLAS"
		]);}
	public static function txtCountry_FR(){ return Lemma::txt([__FUNCTION__
		,en=>"FRANCE"
		,fr=>"FRANCE"
		,de=>"FRANKREICH"
		,es=>"FRANCIA"
		]);}
	public static function txtCountry_GA(){ return Lemma::txt([__FUNCTION__
		,en=>"GABON"
		,fr=>"GABON"
		,de=>"GABUN"
		,es=>"GABÓN"
		]);}
	public static function txtCountry_GB(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED KINGDOM"
		,fr=>"ROYAUME-UNI"
		,de=>"VEREINIGTES KÖNIGREICH"
		,es=>"REINO UNIDO"
		]);}
	public static function txtCountry_GD(){ return Lemma::txt([__FUNCTION__
		,en=>"GRENADA"
		,fr=>"GRENADE"
		,de=>"FÄRÖER"
		,es=>"GRANADA"
		]);}
	public static function txtCountry_GE(){ return Lemma::txt([__FUNCTION__
		,en=>"GEORGIA"
		,fr=>"GÉORGIE"
		,de=>"GEORGIEN"
		,es=>"GEORGIA"
		]);}
	public static function txtCountry_GF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH GUIANA"
		,fr=>"GUYANE FRANÇAISE"
		,de=>"FRANZÖSISCH GUINEA"
		,es=>"GUYANA FRANCESA"
		]);}
	public static function txtCountry_GG(){ return Lemma::txt([__FUNCTION__
		,en=>"GUERNSEY"
		,fr=>"GUERNESEY"
		,de=>"GUERNSEY"
		,es=>"GUERNSEY"
		]);}
	public static function txtCountry_GH(){ return Lemma::txt([__FUNCTION__
		,en=>"GHANA"
		,fr=>"GHANA"
		,de=>"GHANA"
		,es=>"GHANA"
		]);}
	public static function txtCountry_GI(){ return Lemma::txt([__FUNCTION__
		,en=>"GIBRALTAR"
		,fr=>"GIBRALTAR"
		,de=>"GIBRALTAR"
		,es=>"GIBRALTAR"
		]);}
	public static function txtCountry_GL(){ return Lemma::txt([__FUNCTION__
		,en=>"GREENLAND"
		,fr=>"GROENLAND"
		,de=>"GRÖNLAND"
		,es=>"GROENLANDIA"
		]);}
	public static function txtCountry_GM(){ return Lemma::txt([__FUNCTION__
		,en=>"GAMBIA"
		,fr=>"GAMBIE"
		,de=>"GAMBIA"
		,es=>"GAMBIA"
		]);}
	public static function txtCountry_GN(){ return Lemma::txt([__FUNCTION__
		,en=>"GUINEA"
		,fr=>"GUINÉE"
		,de=>"GUINEA"
		,es=>"GUINEA"
		]);}
	public static function txtCountry_GP(){ return Lemma::txt([__FUNCTION__
		,en=>"GUADELOUPE"
		,fr=>"GUADELOUPE"
		,de=>"GUADALOUPE"
		,es=>"GUADALUPE"
		]);}
	public static function txtCountry_GQ(){ return Lemma::txt([__FUNCTION__
		,en=>"EQUATORIAL GUINEA"
		,fr=>"GUINÉE ÉQUATORIALE"
		,de=>"ÄQUATORIAL GUINEA"
		,es=>"GUINEA ECUATORIAL"
		]);}
	public static function txtCountry_GR(){ return Lemma::txt([__FUNCTION__
		,en=>"GREECE"
		,fr=>"GRÈCE"
		,de=>"GRIECHENLAND"
		,es=>"GRECIA"
		]);}
	public static function txtCountry_GS(){ return Lemma::txt([__FUNCTION__
		,en=>"SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS"
		,fr=>"GÉORGIE DU SUD ET LES ÎLES SANDWICH DU SUD"
		,de=>"SÜD-GEORGIEN UND SÜDLICHE SANDWICHINSELN"
		,es=>"GEORGIAS DEL SUR Y SANDWICH, ISLAS"
		]);}
	public static function txtCountry_GT(){ return Lemma::txt([__FUNCTION__
		,en=>"GUATEMALA"
		,fr=>"GUATEMALA"
		,de=>"GUATEMALA"
		,es=>"GUATEMALA"
		]);}
	public static function txtCountry_GU(){ return Lemma::txt([__FUNCTION__
		,en=>"GUAM"
		,fr=>"GUAM"
		,de=>"GUAM"
		,es=>"GUAM"
		]);}
	public static function txtCountry_GW(){ return Lemma::txt([__FUNCTION__
		,en=>"GUINEA-BISSAU"
		,fr=>"GUINÉE-BISSAU"
		,de=>"GUINEA-BISSAU"
		,es=>"GUINEA BISÁU"
		]);}
	public static function txtCountry_GY(){ return Lemma::txt([__FUNCTION__
		,en=>"GUYANA"
		,fr=>"GUYANA"
		,de=>"GUYANA"
		,es=>"GUYANA"
		]);}
	public static function txtCountry_HK(){ return Lemma::txt([__FUNCTION__
		,en=>"HONG KONG"
		,fr=>"HONG-KONG"
		,de=>"HONG-KONG"
		,es=>"HONG KONG"
		]);}
	public static function txtCountry_HM(){ return Lemma::txt([__FUNCTION__
		,en=>"HEARD ISLAND AND MCDONALD ISLANDS"
		,fr=>"HEARD, ÎLE ET MCDONALD, ÎLES"
		,de=>"HEARD INSEL UND MC DONALD INSELN"
		,es=>"HEARD Y MCDONAL, ISLAS"
		]);}
	public static function txtCountry_HN(){ return Lemma::txt([__FUNCTION__
		,en=>"HONDURAS"
		,fr=>"HONDURAS"
		,de=>"HONDURAS"
		,es=>"HONDURAS"
		]);}
	public static function txtCountry_HR(){ return Lemma::txt([__FUNCTION__
		,en=>"CROATIA"
		,fr=>"CROATIE"
		,de=>"KROATIEN"
		,es=>"CROACIA"
		]);}
	public static function txtCountry_HT(){ return Lemma::txt([__FUNCTION__
		,en=>"HAITI"
		,fr=>"HAÏTI"
		,de=>"HAITI"
		,es=>"HAITÍ"
		]);}
	public static function txtCountry_HU(){ return Lemma::txt([__FUNCTION__
		,en=>"HUNGARY"
		,fr=>"HONGRIE"
		,de=>"UNGARN"
		,es=>"HUNGRÍA"
		]);}
	public static function txtCountry_ID(){ return Lemma::txt([__FUNCTION__
		,en=>"INDONESIA"
		,fr=>"INDONÉSIE"
		,de=>"INDONESIEN"
		,es=>"INDONESIA"
		]);}
	public static function txtCountry_IE(){ return Lemma::txt([__FUNCTION__
		,en=>"IRELAND"
		,fr=>"IRLANDE"
		,de=>"IRLAND"
		,es=>"IRLANDA"
		]);}
	public static function txtCountry_IL(){ return Lemma::txt([__FUNCTION__
		,en=>"ISRAEL"
		,fr=>"ISRAËL"
		,de=>"ISRAEL"
		,es=>"ISRAEL"
		]);}
	public static function txtCountry_IM(){ return Lemma::txt([__FUNCTION__
		,en=>"ISLE OF MAN"
		,fr=>"ÎLE DE MAN"
		,de=>"ISLE OF MAN"
		,es=>"ISLA DE MAN"
		]);}
	public static function txtCountry_IN(){ return Lemma::txt([__FUNCTION__
		,en=>"INDIA"
		,fr=>"INDE"
		,de=>"INDIEN"
		,es=>"INDIA"
		]);}
	public static function txtCountry_IO(){ return Lemma::txt([__FUNCTION__
		,en=>"BRITISH INDIAN OCEAN TERRITORY"
		,fr=>"OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L"
		,de=>"BRITISCHES TERRITORIUM IM INDISCHEN OZEAN"
		,es=>"OCÉANO ÍNDICO, TERRITORIO BRITÁNICO DEL"
		]);}
	public static function txtCountry_IQ(){ return Lemma::txt([__FUNCTION__
		,en=>"IRAQ"
		,fr=>"IRAQ"
		,de=>"IRAK"
		,es=>"IRAK"
		]);}
	public static function txtCountry_IR(){ return Lemma::txt([__FUNCTION__
		,en=>"IRAN, ISLAMIC REPUBLIC OF"
		,fr=>"IRAN, RÉPUBLIQUE ISLAMIQUE D"
		,de=>"IRAN, ISLAMISCHE REPUBLIK"
		,es=>"IRÁN, REPÚBLICA ISLÁMICA DE"
		]);}
	public static function txtCountry_IS(){ return Lemma::txt([__FUNCTION__
		,en=>"ICELAND"
		,fr=>"ISLANDE"
		,de=>"ISLAND"
		,es=>"ISLANDIA"
		]);}
	public static function txtCountry_IT(){ return Lemma::txt([__FUNCTION__
		,en=>"ITALY"
		,fr=>"ITALIE"
		,de=>"ITALIEN"
		,es=>"ITALIA"
		]);}
	public static function txtCountry_JE(){ return Lemma::txt([__FUNCTION__
		,en=>"JERSEY"
		,fr=>"JERSEY"
		,de=>"JERSEY"
		,es=>"JERSEY"
		]);}
	public static function txtCountry_JM(){ return Lemma::txt([__FUNCTION__
		,en=>"JAMAICA"
		,fr=>"JAMAÏQUE"
		,de=>"JAMAIKA"
		,es=>"JAMAICA"
		]);}
	public static function txtCountry_JO(){ return Lemma::txt([__FUNCTION__
		,en=>"JORDAN"
		,fr=>"JORDANIE"
		,de=>"JORDANIEN"
		,es=>"JORDANIA"
		]);}
	public static function txtCountry_JP(){ return Lemma::txt([__FUNCTION__
		,en=>"JAPAN"
		,fr=>"JAPON"
		,de=>"JAPAN"
		,es=>"JAPÓN"
		]);}
	public static function txtCountry_KE(){ return Lemma::txt([__FUNCTION__
		,en=>"KENYA"
		,fr=>"KENYA"
		,de=>"KENIA"
		,es=>"KENIA"
		]);}
	public static function txtCountry_KG(){ return Lemma::txt([__FUNCTION__
		,en=>"KYRGYZSTAN"
		,fr=>"KIRGHIZISTAN"
		,de=>"KIRGHISTAN"
		,es=>"KISRGUISTÁN"
		]);}
	public static function txtCountry_KH(){ return Lemma::txt([__FUNCTION__
		,en=>"CAMBODIA"
		,fr=>"CAMBODGE"
		,de=>"KAMBODIA"
		,es=>"CAMBODIA"
		]);}
	public static function txtCountry_KI(){ return Lemma::txt([__FUNCTION__
		,en=>"KIRIBATI"
		,fr=>"KIRIBATI"
		,de=>"KIRIBATI"
		,es=>"KIRIBATI"
		]);}
	public static function txtCountry_KM(){ return Lemma::txt([__FUNCTION__
		,en=>"COMOROS"
		,fr=>"COMORES"
		,de=>"KOMOREN"
		,es=>"COMORAS"
		]);}
	public static function txtCountry_KN(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT KITTS AND NEVIS"
		,fr=>"SAINT-KITTS-ET-NEVIS"
		,de=>"SAINT KITTS UND NEVIS"
		,es=>"SAN KITTS Y NEVIS"
		]);}
	public static function txtCountry_KP(){ return Lemma::txt([__FUNCTION__
		,en=>"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF"
		,fr=>"CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE"
		,de=>"KOREA, DEMOKRATISCHE VOLKSREPUBLIK VON"
		,es=>"COREA, REPÚBLICA DEMOCRÁTICA POPULAR DE"
		]);}
	public static function txtCountry_KR(){ return Lemma::txt([__FUNCTION__
		,en=>"KOREA, REPUBLIC OF"
		,fr=>"CORÉE, RÉPUBLIQUE DE"
		,de=>"KOREA, REPUBLIK VON"
		,es=>"COREA, REPÚBLICA DE"
		]);}
	public static function txtCountry_KW(){ return Lemma::txt([__FUNCTION__
		,en=>"KUWAIT"
		,fr=>"KOWEÏT"
		,de=>"KUWAIT"
		,es=>"KUWAIT"
		]);}
	public static function txtCountry_KY(){ return Lemma::txt([__FUNCTION__
		,en=>"CAYMAN ISLANDS"
		,fr=>"CAÏMANES, ÎLES"
		,de=>"CAYMAN INSELN"
		,es=>"CAIMÁN, ISLAS"
		]);}
	public static function txtCountry_KZ(){ return Lemma::txt([__FUNCTION__
		,en=>"KAZAKHSTAN"
		,fr=>"KAZAKHSTAN"
		,de=>"Kasachstan "
		,es=>"KAZAJISTÁN"
		]);}
	public static function txtCountry_LA(){ return Lemma::txt([__FUNCTION__
		,en=>"LAO PEOPLE'S DEMOCRATIC REPUBLIC"
		,fr=>"LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE"
		,de=>"LAOS, DEMOKRATISCHE VOLKSREPUBLIK"
		,es=>"LAO, REPÚBLICA DEMOCRÁTICA POPULAR DE"
		]);}
	public static function txtCountry_LB(){ return Lemma::txt([__FUNCTION__
		,en=>"LEBANON"
		,fr=>"LIBAN"
		,de=>"LIBANON"
		,es=>"LÍBANO"
		]);}
	public static function txtCountry_LC(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT LUCIA"
		,fr=>"SAINTE-LUCIE"
		,de=>"ST. LUCIA"
		,es=>"SANTA LUCÍA"
		]);}
	public static function txtCountry_LI(){ return Lemma::txt([__FUNCTION__
		,en=>"LIECHTENSTEIN"
		,fr=>"LIECHTENSTEIN"
		,de=>"LIECHTENSTEIN"
		,es=>"LIECHTENSTEIN"
		]);}
	public static function txtCountry_LK(){ return Lemma::txt([__FUNCTION__
		,en=>"SRI LANKA"
		,fr=>"SRI LANKA"
		,de=>"SRI LANKA"
		,es=>"SRI LANKA"
		]);}
	public static function txtCountry_LR(){ return Lemma::txt([__FUNCTION__
		,en=>"LIBERIA"
		,fr=>"LIBÉRIA"
		,de=>"LIBERIA"
		,es=>"LIBERIA"
		]);}
	public static function txtCountry_LS(){ return Lemma::txt([__FUNCTION__
		,en=>"LESOTHO"
		,fr=>"LESOTHO"
		,de=>"LESOTHO"
		,es=>"LESOTO"
		]);}
	public static function txtCountry_LT(){ return Lemma::txt([__FUNCTION__
		,en=>"LITHUANIA"
		,fr=>"LITUANIE"
		,de=>"LITHUANIEN"
		,es=>"LITUANIA"
		]);}
	public static function txtCountry_LU(){ return Lemma::txt([__FUNCTION__
		,en=>"LUXEMBOURG"
		,fr=>"LUXEMBOURG"
		,de=>"LUXEMBURG"
		,es=>"LUXEMBURGO"
		]);}
	public static function txtCountry_LV(){ return Lemma::txt([__FUNCTION__
		,en=>"LATVIA"
		,fr=>"LETTONIE"
		,de=>"LATVIEN"
		,es=>"LETONIA"
		]);}
	public static function txtCountry_LY(){ return Lemma::txt([__FUNCTION__
		,en=>"LIBYAN ARAB JAMAHIRIYA"
		,fr=>"LIBYENNE, JAMAHIRIYA ARABE"
		,de=>"LIBYSCH ARABISCHE VOLKS-DSCHMAHIRIJA"
		,es=>"LIBIA"
		]);}
	public static function txtCountry_MA(){ return Lemma::txt([__FUNCTION__
		,en=>"MOROCCO"
		,fr=>"MAROC"
		,de=>"MAROKKO"
		,es=>"MARRUECOS"
		]);}
	public static function txtCountry_MC(){ return Lemma::txt([__FUNCTION__
		,en=>"MONACO"
		,fr=>"MONACO"
		,de=>"MONACO"
		,es=>"MÓNACO"
		]);}
	public static function txtCountry_MD(){ return Lemma::txt([__FUNCTION__
		,en=>"MOLDOVA, REPUBLIC OF"
		,fr=>"MOLDOVA, RÉPUBLIQUE DE"
		,de=>"MOLDAVIEN, REPUBLIK VON"
		,es=>"MOLDAVIA, REPÚBLICA DE"
		]);}
	public static function txtCountry_ME(){ return Lemma::txt([__FUNCTION__
		,en=>"MONTENEGRO"
		,fr=>"MONTÉNÉGRO"
		,de=>"MONTENEGRO"
		,es=>"MONTENEGRO"
		]);}
	public static function txtCountry_MF(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT MARTIN (FRENCH PART)"
		,fr=>"SAINT-MARTIN(PARTIE FRANÇAISE)"
		,de=>"ST. MARTIN (FRANZÖSISCHER TEIL)"
		,es=>"SAINT MARTIN (PARTE FRANCESA)"
		]);}
	public static function txtCountry_MG(){ return Lemma::txt([__FUNCTION__
		,en=>"MADAGASCAR"
		,fr=>"MADAGASCAR"
		,de=>"MADAGASKAR"
		,es=>"MADAGASCAR"
		]);}
	public static function txtCountry_MH(){ return Lemma::txt([__FUNCTION__
		,en=>"MARSHALL ISLANDS"
		,fr=>"MARSHALL, ÎLES"
		,de=>"MARSCHALLINSELN"
		,es=>"MARSHALL, ISLAS"
		]);}
	public static function txtCountry_MK(){ return Lemma::txt([__FUNCTION__
		,en=>"MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF"
		,fr=>"MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE"
		,de=>"MAZEDONIEN, EHEMALIGE JUGOSLAWISCHE REPUBLIK"
		,es=>"MACEDONIA, ANTIGUA REPÚBLICA YUGOSLAVA DE"
		]);}
	public static function txtCountry_ML(){ return Lemma::txt([__FUNCTION__
		,en=>"MALI"
		,fr=>"MALI"
		,de=>"MALI"
		,es=>"MALI"
		]);}
	public static function txtCountry_MM(){ return Lemma::txt([__FUNCTION__
		,en=>"MYANMAR"
		,fr=>"MYANMAR"
		,de=>"MYANMAR"
		,es=>"MYANMAR"
		]);}
	public static function txtCountry_MN(){ return Lemma::txt([__FUNCTION__
		,en=>"MONGOLIA"
		,fr=>"MONGOLIE"
		,de=>"MONGOLEI"
		,es=>"MONGOLIA"
		]);}
	public static function txtCountry_MO(){ return Lemma::txt([__FUNCTION__
		,en=>"MACAO"
		,fr=>"MACAO"
		,de=>"MACAU"
		,es=>"MACAO"
		]);}
	public static function txtCountry_MP(){ return Lemma::txt([__FUNCTION__
		,en=>"NORTHERN MARIANA ISLANDS"
		,fr=>"MARIANNES DU NORD, ÎLES"
		,de=>"NÖRDLICHE MARIANEN"
		,es=>"MARIANAS DEL NORTE, ISLAS"
		]);}
	public static function txtCountry_MQ(){ return Lemma::txt([__FUNCTION__
		,en=>"MARTINIQUE"
		,fr=>"MARTINIQUE"
		,de=>"MARTINIQUE"
		,es=>"MARTINICA"
		]);}
	public static function txtCountry_MR(){ return Lemma::txt([__FUNCTION__
		,en=>"MAURITANIA"
		,fr=>"MAURITANIE"
		,de=>"MAURETANIEN"
		,es=>"MAURITANIA"
		]);}
	public static function txtCountry_MS(){ return Lemma::txt([__FUNCTION__
		,en=>"MONTSERRAT"
		,fr=>"MONTSERRAT"
		,de=>"MONTSERRAT"
		,es=>"MONSERRAT"
		]);}
	public static function txtCountry_MT(){ return Lemma::txt([__FUNCTION__
		,en=>"MALTA"
		,fr=>"MALTE"
		,de=>"MALTA"
		,es=>"MALTA"
		]);}
	public static function txtCountry_MU(){ return Lemma::txt([__FUNCTION__
		,en=>"MAURITIUS"
		,fr=>"MAURICE"
		,de=>"MAURITIUS"
		,es=>"MAURICIO"
		]);}
	public static function txtCountry_MV(){ return Lemma::txt([__FUNCTION__
		,en=>"MALDIVES"
		,fr=>"MALDIVES"
		,de=>"MALEDIVEN"
		,es=>"MALDIVAS"
		]);}
	public static function txtCountry_MW(){ return Lemma::txt([__FUNCTION__
		,en=>"MALAWI"
		,fr=>"MALAWI"
		,de=>"MALAWI"
		,es=>"MALAWI"
		]);}
	public static function txtCountry_MX(){ return Lemma::txt([__FUNCTION__
		,en=>"MEXICO"
		,fr=>"MEXIQUE"
		,de=>"MEXIKO"
		,es=>"MÉXICO"
		]);}
	public static function txtCountry_MY(){ return Lemma::txt([__FUNCTION__
		,en=>"MALAYSIA"
		,fr=>"MALAISIE"
		,de=>"MALAYSIA"
		,es=>"MALASIA"
		]);}
	public static function txtCountry_MZ(){ return Lemma::txt([__FUNCTION__
		,en=>"MOZAMBIQUE"
		,fr=>"MOZAMBIQUE"
		,de=>"MOSAMBIK"
		,es=>"MOZAMBIQUE"
		]);}
	public static function txtCountry_NA(){ return Lemma::txt([__FUNCTION__
		,en=>"NAMIBIA"
		,fr=>"NAMIBIE"
		,de=>"NAMIBIA"
		,es=>"NAMIBIA"
		]);}
	public static function txtCountry_NC(){ return Lemma::txt([__FUNCTION__
		,en=>"NEW CALEDONIA"
		,fr=>"NOUVELLE-CALÉDONIE"
		,de=>"NEUKALEDONIEN"
		,es=>"NUEVA CALEDONIA"
		]);}
	public static function txtCountry_NE(){ return Lemma::txt([__FUNCTION__
		,en=>"NIGER"
		,fr=>"NIGER"
		,de=>"NIGERI"
		,es=>"NIGERIA"
		]);}
	public static function txtCountry_NF(){ return Lemma::txt([__FUNCTION__
		,en=>"NORFOLK ISLAND"
		,fr=>"NORFOLK, ÎLE"
		,de=>"NORFOLK-INSELN"
		,es=>"NORFOLK, ISLA"
		]);}
	public static function txtCountry_NG(){ return Lemma::txt([__FUNCTION__
		,en=>"NIGERIA"
		,fr=>"NIGÉRIA"
		,de=>"NIGERIA"
		,es=>"NIGERIA"
		]);}
	public static function txtCountry_NI(){ return Lemma::txt([__FUNCTION__
		,en=>"NICARAGUA"
		,fr=>"NICARAGUA"
		,de=>"NICARAGUA"
		,es=>"NICARAGUA"
		]);}
	public static function txtCountry_NL(){ return Lemma::txt([__FUNCTION__
		,en=>"NETHERLANDS"
		,fr=>"PAYS-BAS"
		,de=>"NIEDERLANDE"
		,es=>"PAÍSES BAJOS"
		]);}
	public static function txtCountry_NO(){ return Lemma::txt([__FUNCTION__
		,en=>"NORWAY"
		,fr=>"NORVÈGE"
		,de=>"NORWEGEN"
		,es=>"NORUEGA"
		]);}
	public static function txtCountry_NP(){ return Lemma::txt([__FUNCTION__
		,en=>"NEPAL"
		,fr=>"NÉPAL"
		,de=>"NEPAL"
		,es=>"NEPAL"
		]);}
	public static function txtCountry_NR(){ return Lemma::txt([__FUNCTION__
		,en=>"NAURU"
		,fr=>"NAURU"
		,de=>"NAURU"
		,es=>"NAURU"
		]);}
	public static function txtCountry_NU(){ return Lemma::txt([__FUNCTION__
		,en=>"NIUE"
		,fr=>"NIUÉ"
		,de=>"NIUE"
		,es=>"NIUE"
		]);}
	public static function txtCountry_NZ(){ return Lemma::txt([__FUNCTION__
		,en=>"NEW ZEALAND"
		,fr=>"NOUVELLE-ZÉLANDE"
		,de=>"NEUSEELAND"
		,es=>"NUEVA ZELANDA"
		]);}
	public static function txtCountry_OM(){ return Lemma::txt([__FUNCTION__
		,en=>"OMAN"
		,fr=>"OMAN"
		,de=>"OMAN"
		,es=>"OMÁN"
		]);}
	public static function txtCountry_PA(){ return Lemma::txt([__FUNCTION__
		,en=>"PANAMA"
		,fr=>"PANAMA"
		,de=>"PANAMA"
		,es=>"PANAMÁ"
		]);}
	public static function txtCountry_PE(){ return Lemma::txt([__FUNCTION__
		,en=>"PERU"
		,fr=>"PÉROU"
		,de=>"PERU"
		,es=>"PERÚ"
		]);}
	public static function txtCountry_PF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH POLYNESIA"
		,fr=>"POLYNÉSIE FRANÇAISE"
		,de=>"FRANZÖSISCH POLYNESIEN"
		,es=>"POLINESIA FRANCESA"
		]);}
	public static function txtCountry_PG(){ return Lemma::txt([__FUNCTION__
		,en=>"PAPUA NEW GUINEA"
		,fr=>"PAPOUASIE-NOUVELLE-GUINÉE"
		,de=>"PAPUA NEU GUINEA"
		,es=>"PAPÚA NUEVA GUINEA"
		]);}
	public static function txtCountry_PH(){ return Lemma::txt([__FUNCTION__
		,en=>"PHILIPPINES"
		,fr=>"PHILIPPINES"
		,de=>"PHILLIPPINEN"
		,es=>"FILIPINAS"
		]);}
	public static function txtCountry_PK(){ return Lemma::txt([__FUNCTION__
		,en=>"PAKISTAN"
		,fr=>"PAKISTAN"
		,de=>"PAKISTAN"
		,es=>"PAKISTÁN"
		]);}
	public static function txtCountry_PL(){ return Lemma::txt([__FUNCTION__
		,en=>"POLAND"
		,fr=>"POLOGNE"
		,de=>"POLEN"
		,es=>"POLONIA"
		]);}
	public static function txtCountry_PM(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT PIERRE AND MIQUELON"
		,fr=>"SAINT-PIERRE-ET-MIQUELON"
		,de=>"SAINT PIERRE UND MIQUELON"
		,es=>"SAN PEDRO Y MIQUELÓN"
		]);}
	public static function txtCountry_PN(){ return Lemma::txt([__FUNCTION__
		,en=>"PITCAIRN"
		,fr=>"PITCAIRN"
		,de=>"PITCAIRN"
		,es=>"PITCAIRN"
		]);}
	public static function txtCountry_PR(){ return Lemma::txt([__FUNCTION__
		,en=>"PUERTO RICO"
		,fr=>"PORTO RICO"
		,de=>"PUERTO RICO"
		,es=>"PUERTO RICO"
		]);}
	public static function txtCountry_PS(){ return Lemma::txt([__FUNCTION__
		,en=>"PALESTINIAN TERRITORY, OCCUPIED"
		,fr=>"PALESTINIEN OCCUPÉ, TERRITOIRE"
		,de=>"PALÄSTINENSER GEBIET, BESETZT"
		,es=>"PALESTINO OCUPADO, TERRITORIO"
		]);}
	public static function txtCountry_PT(){ return Lemma::txt([__FUNCTION__
		,en=>"PORTUGAL"
		,fr=>"PORTUGAL"
		,de=>"PORTUGAL"
		,es=>"PORTUGAL"
		]);}
	public static function txtCountry_PW(){ return Lemma::txt([__FUNCTION__
		,en=>"PALAU"
		,fr=>"PALAOS"
		,de=>"PALAU"
		,es=>"País_PW"
		]);}
	public static function txtCountry_PY(){ return Lemma::txt([__FUNCTION__
		,en=>"PARAGUAY"
		,fr=>"PARAGUAY"
		,de=>"PARAGUAY"
		,es=>"PARAGUAY"
		]);}
	public static function txtCountry_QA(){ return Lemma::txt([__FUNCTION__
		,en=>"QATAR"
		,fr=>"QATAR"
		,de=>"QATAR"
		,es=>"CATAR"
		]);}
	public static function txtCountry_RE(){ return Lemma::txt([__FUNCTION__
		,en=>"RÉUNION"
		,fr=>"RÉUNION"
		,de=>"RÉUNION"
		,es=>"REUNIÓN"
		]);}
	public static function txtCountry_RO(){ return Lemma::txt([__FUNCTION__
		,en=>"ROMANIA"
		,fr=>"ROUMANIE"
		,de=>"RUMÄNIEN"
		,es=>"RUMANÍA"
		]);}
	public static function txtCountry_RS(){ return Lemma::txt([__FUNCTION__
		,en=>"SERBIA"
		,fr=>"SERBIE"
		,de=>"SERBIEN"
		,es=>"SERBIA"
		]);}
	public static function txtCountry_RU(){ return Lemma::txt([__FUNCTION__
		,en=>"RUSSIAN FEDERATION"
		,fr=>"RUSSIE, FÉDÉRATION DE"
		,de=>"RUSSISCHE FÖDERATION"
		,es=>"RUSIA, FEDERACIÓN DE"
		]);}
	public static function txtCountry_RW(){ return Lemma::txt([__FUNCTION__
		,en=>"RWANDA"
		,fr=>"RWANDA"
		,de=>"RUANDA"
		,es=>"RUANDA"
		]);}
	public static function txtCountry_SA(){ return Lemma::txt([__FUNCTION__
		,en=>"SAUDI ARABIA"
		,fr=>"ARABIE SAOUDITE"
		,de=>"SAUDIARABIEN"
		,es=>"ARABIA SAUDITA"
		]);}
	public static function txtCountry_SB(){ return Lemma::txt([__FUNCTION__
		,en=>"SOLOMON ISLANDS"
		,fr=>"SALOMON, ÎLES"
		,de=>"SALOMONINSELN"
		,es=>"SALOMÓN, ISLAS"
		]);}
	public static function txtCountry_SC(){ return Lemma::txt([__FUNCTION__
		,en=>"SEYCHELLES"
		,fr=>"SEYCHELLES"
		,de=>"SEYCHELLEN"
		,es=>"SEYCHELLES"
		]);}
	public static function txtCountry_SD(){ return Lemma::txt([__FUNCTION__
		,en=>"SUDAN"
		,fr=>"SOUDAN"
		,de=>"SUDAN"
		,es=>"SUDÁN"
		]);}
	public static function txtCountry_SE(){ return Lemma::txt([__FUNCTION__
		,en=>"SWEDEN"
		,fr=>"SUÈDE"
		,de=>"SCHWEDEN"
		,es=>"SUECIA"
		]);}
	public static function txtCountry_SG(){ return Lemma::txt([__FUNCTION__
		,en=>"SINGAPORE"
		,fr=>"SINGAPOUR"
		,de=>"SINGAPUR"
		,es=>"SINGAPUR"
		]);}
	public static function txtCountry_SH(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA"
		,fr=>"SAINTE-HÉLÈNE, ASCENSION ET TRISTAN DA CUNHA"
		,de=>"ST. HELENA UND DIE INSELN  TRISTAN DA CUNHA UND ASCENSION"
		,es=>"SANTA ELENA, ASCENSIÓN Y TRISTÁN DE ACUÑA"
		]);}
	public static function txtCountry_SI(){ return Lemma::txt([__FUNCTION__
		,en=>"SLOVENIA"
		,fr=>"SLOVÉNIE"
		,de=>"SLOWENIEN"
		,es=>"ESLOVENIA"
		]);}
	public static function txtCountry_SJ(){ return Lemma::txt([__FUNCTION__
		,en=>"SVALBARD AND JAN MAYEN"
		,fr=>"SVALBARD ET ÎLE JAN MAYEN"
		,de=>"SVALBARD UND DIE INSEL JAN MAYEN"
		,es=>"SVALBARD E ISLA JAN MAYEN"
		]);}
	public static function txtCountry_SK(){ return Lemma::txt([__FUNCTION__
		,en=>"SLOVAKIA"
		,fr=>"SLOVAQUIE"
		,de=>"SLOWAKIEN"
		,es=>"ESLOVAQUIA"
		]);}
	public static function txtCountry_SL(){ return Lemma::txt([__FUNCTION__
		,en=>"SIERRA LEONE"
		,fr=>"SIERRA LEONE"
		,de=>"SIERRA LEONE"
		,es=>"SIERRA LEONA"
		]);}
	public static function txtCountry_SM(){ return Lemma::txt([__FUNCTION__
		,en=>"SAN MARINO"
		,fr=>"SAINT-MARIN"
		,de=>"SAN MARINO"
		,es=>"SAN MARINO"
		]);}
	public static function txtCountry_SN(){ return Lemma::txt([__FUNCTION__
		,en=>"SENEGAL"
		,fr=>"SÉNÉGAL"
		,de=>"SENEGAL"
		,es=>"SENEGAL"
		]);}
	public static function txtCountry_SO(){ return Lemma::txt([__FUNCTION__
		,en=>"SOMALIA"
		,fr=>"SOMALIE"
		,de=>"SOMALIA"
		,es=>"SOMALIA"
		]);}
	public static function txtCountry_SR(){ return Lemma::txt([__FUNCTION__
		,en=>"SURINAME"
		,fr=>"SURINAME"
		,de=>"SURINAME"
		,es=>"SURINAM"
		]);}
	public static function txtCountry_ST(){ return Lemma::txt([__FUNCTION__
		,en=>"SAO TOME AND PRINCIPE"
		,fr=>"SAO TOMÉ-ET-PRINCIPE"
		,de=>"SAO TOME UND PRINCIPE"
		,es=>"SANTO TOMÉ Y PRÍNCIPE"
		]);}
	public static function txtCountry_SV(){ return Lemma::txt([__FUNCTION__
		,en=>"EL SALVADOR"
		,fr=>"EL SALVADOR"
		,de=>"EL SALVADOR"
		,es=>"EL SALVADOR"
		]);}
	public static function txtCountry_SX(){ return Lemma::txt([__FUNCTION__
		,en=>"SINT MAARTEN (DUTCH PART)"
		,fr=>"SAINT-MARTIN (PARTIE NÉERLANDAISE)"
		,de=>"SANKT MARTIN (NIEDERLÄNDISCHER TEIL) "
		,es=>"SAINT MARTIN (PARTE HOLANDESA)"
		]);}
	public static function txtCountry_SY(){ return Lemma::txt([__FUNCTION__
		,en=>"SYRIAN ARAB REPUBLIC"
		,fr=>"SYRIENNE, RÉPUBLIQUE ARABE"
		,de=>"SYRIEN, ARABISCHE REPUBLIK"
		,es=>"SIRIA, REPÚBLICA ÁRABE"
		]);}
	public static function txtCountry_SZ(){ return Lemma::txt([__FUNCTION__
		,en=>"SWAZILAND"
		,fr=>"SWAZILAND"
		,de=>"SWAZILAND"
		,es=>"SUAZILANDIA"
		]);}
	public static function txtCountry_TC(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKS AND CAICOS ISLANDS"
		,fr=>"TURKS ET CAÏQUES, ÎLES"
		,de=>"TURKS UND CAICOS INSELN"
		,es=>"ISLAS TURCAS Y CAICOS"
		]);}
	public static function txtCountry_TD(){ return Lemma::txt([__FUNCTION__
		,en=>"CHAD"
		,fr=>"TCHAD"
		,de=>"TSCHAD"
		,es=>"CHAD"
		]);}
	public static function txtCountry_TF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH SOUTHERN TERRITORIES"
		,fr=>"TERRES AUSTRALES FRANÇAISES"
		,de=>"FRANZÖSISCHE SÜDPOLAR-TERRITORIEN"
		,es=>"TIERRAS AUSTRALES Y ANTÁRTICAS FRANCESAS"
		]);}
	public static function txtCountry_TG(){ return Lemma::txt([__FUNCTION__
		,en=>"TOGO"
		,fr=>"TOGO"
		,de=>"TOGO"
		,es=>"TOGO"
		]);}
	public static function txtCountry_TH(){ return Lemma::txt([__FUNCTION__
		,en=>"THAILAND"
		,fr=>"THAÏLANDE"
		,de=>"THAILAND"
		,es=>"TAILANDIA"
		]);}
	public static function txtCountry_TJ(){ return Lemma::txt([__FUNCTION__
		,en=>"TAJIKISTAN"
		,fr=>"TADJIKISTAN"
		,de=>"TADSCHIKISTAN"
		,es=>"TAYIKISTÁN"
		]);}
	public static function txtCountry_TK(){ return Lemma::txt([__FUNCTION__
		,en=>"TOKELAU"
		,fr=>"TOKELAU"
		,de=>"TOKELAU"
		,es=>"TOKELAU"
		]);}
	public static function txtCountry_TL(){ return Lemma::txt([__FUNCTION__
		,en=>"TIMOR-LESTE"
		,fr=>"TIMOR-LESTE"
		,de=>"TIMOR-LESTE"
		,es=>"TIMOR-LESTE"
		]);}
	public static function txtCountry_TM(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKMENISTAN"
		,fr=>"TURKMÉNISTAN"
		,de=>"TURKMENISTAN"
		,es=>"TURKMENISTÁN"
		]);}
	public static function txtCountry_TN(){ return Lemma::txt([__FUNCTION__
		,en=>"TUNISIA"
		,fr=>"TUNISIE"
		,de=>"TUNESIEN"
		,es=>"TÚNEZ"
		]);}
	public static function txtCountry_TO(){ return Lemma::txt([__FUNCTION__
		,en=>"TONGA"
		,fr=>"TONGA"
		,de=>"TONGA"
		,es=>"TONGA"
		]);}
	public static function txtCountry_TR(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKEY"
		,fr=>"TURQUIE"
		,de=>"TÜRKEI"
		,es=>"TURQUÍA"
		]);}
	public static function txtCountry_TT(){ return Lemma::txt([__FUNCTION__
		,en=>"TRINIDAD AND TOBAGO"
		,fr=>"TRINITÉ-ET-TOBAGO"
		,de=>"TRINIDAD UND TOBAGO"
		,es=>"TRINIDAD Y TOBAGO"
		]);}
	public static function txtCountry_TV(){ return Lemma::txt([__FUNCTION__
		,en=>"TUVALU"
		,fr=>"TUVALU"
		,de=>"TUVALU"
		,es=>"TUVALU"
		]);}
	public static function txtCountry_TW(){ return Lemma::txt([__FUNCTION__
		,en=>"TAIWAN, PROVINCE OF CHINA"
		,fr=>"TAÏWAN, PROVINCE DE CHINE"
		,de=>"TAIWAN, CHINESISCHE PROVINZ"
		,es=>"TAIWÁN, PROVINCIA DE CHINA"
		]);}
	public static function txtCountry_TZ(){ return Lemma::txt([__FUNCTION__
		,en=>"TANZANIA, UNITED REPUBLIC OF"
		,fr=>"TANZANIE, RÉPUBLIQUE-UNIE DE"
		,de=>"TANSANIA, VEREINIGTE REPUBLIK VON"
		,es=>"TANZANIA, REPÚBLICA UNIDA DE"
		]);}
	public static function txtCountry_UA(){ return Lemma::txt([__FUNCTION__
		,en=>"UKRAINE"
		,fr=>"UKRAINE"
		,de=>"UKRAINE"
		,es=>"UCRANIA"
		]);}
	public static function txtCountry_UG(){ return Lemma::txt([__FUNCTION__
		,en=>"UGANDA"
		,fr=>"OUGANDA"
		,de=>"UGANDA"
		,es=>"UGANDA"
		]);}
	public static function txtCountry_UM(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED STATES MINOR OUTLYING ISLANDS"
		,fr=>"ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS"
		,de=>"AMERIKANISCH-OZEANIEN"
		,es=>"ISLAS ULTRAMARINAS MENORES DE ESTADOS UNIDOS"
		]);}
	public static function txtCountry_US(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED STATES"
		,fr=>"ÉTATS-UNIS"
		,de=>"VEREINIGTE STAATEN VON AMERIKA"
		,es=>"ESTADOS UNIDOS"
		]);}
	public static function txtCountry_UY(){ return Lemma::txt([__FUNCTION__
		,en=>"URUGUAY"
		,fr=>"URUGUAY"
		,de=>"URUGUAY"
		,es=>"URUGUAY"
		]);}
	public static function txtCountry_UZ(){ return Lemma::txt([__FUNCTION__
		,en=>"UZBEKISTAN"
		,fr=>"OUZBÉKISTAN"
		,de=>"USBEKISTAN"
		,es=>"UZBEKISTÁN"
		]);}
	public static function txtCountry_VA(){ return Lemma::txt([__FUNCTION__
		,en=>"HOLY SEE (VATICAN CITY STATE)"
		,fr=>"SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)"
		,de=>"HEILIGER STUHL (VATIKANSTADT)"
		,es=>"SANTA SEDE (CIUDAD ESTADO DEL VATICANO)"
		]);}
	public static function txtCountry_VC(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT VINCENT AND THE GRENADINES"
		,fr=>"SAINT-VINCENT-ET-LES GRENADINES"
		,de=>"SANKT VINCENT UND DIE GRENADINEN"
		,es=>"SAN VICENTE Y LAS GRANADINAS"
		]);}
	public static function txtCountry_VE(){ return Lemma::txt([__FUNCTION__
		,en=>"VENEZUELA, BOLIVARIAN REPUBLIC OF"
		,fr=>"VENEZUELA, RÉPUBLIQUE BOLIVARIENNE DU"
		,de=>"VENEZUELA, BOLIVARISCHE REPUBLIK"
		,es=>"VENEZUELA, REPÚBLICA BOLIVARIANA DE"
		]);}
	public static function txtCountry_VG(){ return Lemma::txt([__FUNCTION__
		,en=>"VIRGIN ISLANDS, BRITISH"
		,fr=>"ÎLES VIERGES BRITANNIQUES"
		,de=>"BRITISCHE JUNGFERNINSELN"
		,es=>"ISLAS VÍRGENES BRITÁNICAS"
		]);}
	public static function txtCountry_VI(){ return Lemma::txt([__FUNCTION__
		,en=>"VIRGIN ISLANDS, U.S."
		,fr=>"ÎLES VIERGES DES ÉTATS-UNIS"
		,de=>"US-JUNGFERNINSELN"
		,es=>"ISLAS VÍRGENES DE LOS ESTADOS UNIDOS"
		]);}
	public static function txtCountry_VN(){ return Lemma::txt([__FUNCTION__
		,en=>"VIET NAM"
		,fr=>"VIET NAM"
		,de=>"VIETNAM"
		,es=>"VIETNAM"
		]);}
	public static function txtCountry_VU(){ return Lemma::txt([__FUNCTION__
		,en=>"VANUATU"
		,fr=>"VANUATU"
		,de=>"VANUATU"
		,es=>"VANUATU"
		]);}
	public static function txtCountry_WF(){ return Lemma::txt([__FUNCTION__
		,en=>"WALLIS AND FUTUNA"
		,fr=>"WALLIS ET FUTUNA"
		,de=>"WALLIS UND FUTUNA"
		,es=>"WALLIS Y FUTUNA"
		]);}
	public static function txtCountry_WS(){ return Lemma::txt([__FUNCTION__
		,en=>"SAMOA"
		,fr=>"SAMOA"
		,de=>"SAMOA"
		,es=>"SAMOA"
		]);}
	public static function txtCountry_YE(){ return Lemma::txt([__FUNCTION__
		,en=>"YEMEN"
		,fr=>"YÉMEN"
		,de=>"JEMEN"
		,es=>"YEMEN"
		]);}
	public static function txtCountry_YT(){ return Lemma::txt([__FUNCTION__
		,en=>"MAYOTTE"
		,fr=>"MAYOTTE"
		,de=>"MAYOTTE"
		,es=>"MAYOTTE"
		]);}
	public static function txtCountry_ZA(){ return Lemma::txt([__FUNCTION__
		,en=>"SOUTH AFRICA"
		,fr=>"AFRIQUE DU SUD"
		,de=>"SÜDAFRIKA"
		,es=>"SUDÁFRICA"
		]);}
	public static function txtCountry_ZM(){ return Lemma::txt([__FUNCTION__
		,en=>"ZAMBIA"
		,fr=>"ZAMBIE"
		,de=>"SAMBIA"
		,es=>"ZAMBIA"
		]);}
	public static function txtCountry_ZW(){ return Lemma::txt([__FUNCTION__
		,en=>"ZIMBABWE"
		,fr=>"ZIMBABWE"
		,de=>"ZIMBABWE"
		,es=>"ZIMBABWE"
		]);}

}

