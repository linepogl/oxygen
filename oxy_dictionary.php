<?php
define('en','en');
define('el','el');
define('fr','fr');
abstract class _oxy_dictionary extends ResourceManager {

	public static function txt_locale(){ return Lemma::txt([__FUNCTION__
		,en=>"en_GB"
		,fr=>"fr_FR"
		,el=>"el_GR"
		]);}
	public static function txt_thousands_separator(){ return Lemma::txt([__FUNCTION__
		,en=>","
		,fr=>" "
		,el=>"."
		]);}
	public static function txt_decimal_separator(){ return Lemma::txt([__FUNCTION__
		,en=>"."
		,fr=>","
		,el=>","
		]);}

	public static function txtLanguage(){ return Lemma::txt([__FUNCTION__
		,en=>"Language"
		,fr=>"Langue"
		,el=>"Γλώσσα"
		]);}
	public static function txtName(){ return Lemma::txt([__FUNCTION__
		,en=>"Name"
		,fr=>"Nom"
		,el=>"Όνομα"
		]);}
	public static function txtSurname(){ return Lemma::txt([__FUNCTION__
		,en=>"Surname"
		,fr=>"Nom"
		,el=>"Επίθετο"
		]);}
	public static function txtFirstName(){ return Lemma::txt([__FUNCTION__
		,en=>"Name"
		,fr=>"Prénom"
		,el=>"Όνομα"
		]);}
	public static function txtCompany(){ return Lemma::txt([__FUNCTION__
		,en=>"Company"
		,fr=>"Société"
		,el=>"Εταιρία"
		]);}
	public static function txtPosition(){ return Lemma::txt([__FUNCTION__
		,en=>"Position"
		,fr=>"Position"
		,el=>"Θέση"
		]);}
	public static function txtGender(){ return Lemma::txt([__FUNCTION__
		,en=>"Gender"
		,fr=>"Sexe"
		,el=>"Φύλο"
		]);}
	public static function txtMale(){ return Lemma::txt([__FUNCTION__
		,en=>"Male"
		,fr=>"Homme"
		,el=>"Άρρεν"
		]);}
	public static function txtFemale(){ return Lemma::txt([__FUNCTION__
		,en=>"Female"
		,fr=>"Femme"
		,el=>"Θύλη"
		]);}
	public static function txtPhone(){ return Lemma::txt([__FUNCTION__
		,en=>"Phone"
		,fr=>"Téléphone"
		,el=>"Τηλέφωνο"
		]);}
	public static function txtEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"E-mail"
		,fr=>"E-mail"
		,el=>"E-mail"
		]);}
	public static function txtAddress(){ return Lemma::txt([__FUNCTION__
		,en=>"Address"
		,fr=>"Adresse"
		,el=>"Διεύθυνση"
		]);}
	public static function txtCity(){ return Lemma::txt([__FUNCTION__
		,en=>"City"
		,fr=>"Ville"
		,el=>"Πόλη"
		]);}
	public static function txtZip(){ return Lemma::txt([__FUNCTION__
		,en=>"Postal code"
		,fr=>"Code postal"
		,el=>"Τ.Κ."
		]);}
	public static function txtCountry(){ return Lemma::txt([__FUNCTION__
		,en=>"Country"
		,fr=>"Pays"
		,el=>"Χώρα"
		]);}
	public static function txtComments(){ return Lemma::txt([__FUNCTION__
		,en=>"Comments"
		,fr=>"Commentaires"
		,el=>"Σχόλια"
		]);}
	public static function txtUsername(){ return Lemma::txt([__FUNCTION__
		,en=>"Username"
		,fr=>"Identifiant"
		,el=>"Username"
		]);}
	public static function txtPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Password"
		,fr=>"Mot de passe"
		,el=>"Κωδικός"
		]);}
	public static function txtOldPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Old password"
		,fr=>"Ancien mot de passe"
		,el=>"Παλιός κωδικός"
		]);}
	public static function txtNewPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"New password"
		,fr=>"Nouveau mot de passe"
		,el=>"Νέος κωδικός"
		]);}
	public static function txtConfirmPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Confirm"
		,fr=>"Confirmer"
		,el=>"Επιβεβαίωση"
		]);}
	public static function txtDateCreated(){ return Lemma::txt([__FUNCTION__
		,en=>"Date created"
		,fr=>"Date de création"
		,el=>"Ημ.δημιουργίας"
		]);}
	public static function txtDateModified(){ return Lemma::txt([__FUNCTION__
		,en=>"Date modified"
		,fr=>"Date de modification"
		,el=>"Ημ.μεταβολής"
		]);}
	public static function txtEmailRcpt(){ return Lemma::txt([__FUNCTION__
		,en=>"To"
		,fr=>"A"
		,el=>"Πρoς"
		]);}
	public static function txtEmailSubject(){ return Lemma::txt([__FUNCTION__
		,en=>"Subject"
		,fr=>"Sujet"
		,el=>"Θέμα"
		]);}
	public static function txtEmailBody(){ return Lemma::txt([__FUNCTION__
		,en=>"Body"
		,fr=>"Message"
		,el=>"Κείμενο"
		]);}
	public static function txtEmailFrom(){ return Lemma::txt([__FUNCTION__
		,en=>"From"
		,fr=>"De"
		,el=>"Από"
		]);}
	public static function txtDateSent(){ return Lemma::txt([__FUNCTION__
		,en=>"Date sent"
		,fr=>"Date d'envoi"
		,el=>"Ημ.αποστολής"
		]);}
	public static function txtLockedAccount(){ return Lemma::txt([__FUNCTION__
		,en=>"Locked account"
		,fr=>"Compte bloqué"
		,el=>"Κλειδωμένος λογαριασμός"
		]);}
	public static function txtFile(){ return Lemma::txt([__FUNCTION__
		,en=>"File"
		,fr=>"Fichier"
		,el=>"Αρχείο"
		]);}



	public static function txtDate(){ return Lemma::txt([__FUNCTION__
		,en=>"Date"
		,fr=>"Date"
		,el=>"Ημερομηνία"
		]);}
	public static function txtTime(){ return Lemma::txt([__FUNCTION__
		,en=>"Time"
		,fr=>"Heure"
		,el=>"Ώρα"
		]);}
	public static function txtToday(){ return Lemma::txt([__FUNCTION__
		,en=>"Today"
		,fr=>"Aujourd'hui"
		,el=>"Σήμερα"
		]);}
	public static function txtTomorrow(){ return Lemma::txt([__FUNCTION__
		,en=>"Tomorrow"
		,fr=>"Demain"
		,el=>"Αύριο"
		]);}
	public static function txtYesterday(){ return Lemma::txt([__FUNCTION__
		,en=>"Yesterday"
		,fr=>"Hier"
		,el=>"Xθες"
		]);}
	public static function txtNow(){ return Lemma::txt([__FUNCTION__
		,en=>"Now"
		,fr=>"Maintenant"
		,el=>"Τώρα"
		]);}
	public static function txtAM(){ return Lemma::txt([__FUNCTION__
		,en=>"a.m."
		,fr=>"avant-midi"
		,el=>"π.μ."
		]);}
	public static function txtPM(){ return Lemma::txt([__FUNCTION__
		,en=>"p.m."
		,fr=>"après-midi"
		,el=>"μ.μ."
		]);}
	public static function txtDay(){ return Lemma::txt([__FUNCTION__
		,en=>"Day"
		,fr=>"Jour"
		,el=>"Ημέρα"
		]);}
	public static function txtDayOfWeek(){ return Lemma::txt([__FUNCTION__
		,en=>"Day of week"
		,fr=>"Jour de la semaine"
		,el=>"Ημέρα της εβδομάδας"
		]);}
	public static function txtNight(){ return Lemma::txt([__FUNCTION__
		,en=>"Night"
		,fr=>"Nuit"
		,el=>"Νύχτα"
		]);}
	public static function txtDays(){ return Lemma::txt([__FUNCTION__
		,en=>"Days"
		,fr=>"Jours"
		,el=>"Ημέρες"
		]);}
	public static function txtXDays(){ return Lemma::txt([__FUNCTION__
		,en=>"%s days"
		,fr=>"%s jours"
		,el=>"%s ημέρες"
		]);}
	public static function txtXDaysAgo(){ return Lemma::txt([__FUNCTION__
		,en=>"%s days ago"
		,fr=>"Il y a %s jours"
		,el=>"Πριν από %s ημέρες"
		]);}
	public static function txtXTimeAgo(){ return Lemma::txt([__FUNCTION__
		,en=>"%s ago"
		,fr=>"Il y a %s"
		,el=>"Πριν από %s"
		]);}
	public static function txtInXDays(){ return Lemma::txt([__FUNCTION__
		,en=>"In %s days"
		,fr=>"Dans %s jours"
		,el=>"Σε %s ημέρες"
		]);}
	public static function txtInXTime(){ return Lemma::txt([__FUNCTION__
		,en=>"In %s"
		,fr=>"Dans %s"
		,el=>"Σε %s"
		]);}
	public static function txtTimeZone(){ return Lemma::txt([__FUNCTION__
		,en=>"Time zone"
		,fr=>"Fuseau horaire"
		,el=>"Ζώνη ώρας"
		]);}
	public static function txtJanuary(){ return Lemma::txt([__FUNCTION__
		,en=>"January"
		,fr=>"janvier"
		,el=>"Ιανουάριος"
		]);}
	public static function txtFebruary(){ return Lemma::txt([__FUNCTION__
		,en=>"February"
		,fr=>"février"
		,el=>"Φεβρουάριος"
		]);}
	public static function txtMarch(){ return Lemma::txt([__FUNCTION__
		,en=>"March"
		,fr=>"mars"
		,el=>"Μάρτιος"
		]);}
	public static function txtApril(){ return Lemma::txt([__FUNCTION__
		,en=>"April"
		,fr=>"avril"
		,el=>"Απρίλιος"
		]);}
	public static function txtMay(){ return Lemma::txt([__FUNCTION__
		,en=>"May"
		,fr=>"mai"
		,el=>"Μάιος"
		]);}
	public static function txtJune(){ return Lemma::txt([__FUNCTION__
		,en=>"June"
		,fr=>"juin"
		,el=>"Ιούνιος"
		]);}
	public static function txtJuly(){ return Lemma::txt([__FUNCTION__
		,en=>"July"
		,fr=>"juillet"
		,el=>"Ιούλιος"
		]);}
	public static function txtAugust(){ return Lemma::txt([__FUNCTION__
		,en=>"August"
		,fr=>"août"
		,el=>"Αύγουστος"
		]);}
	public static function txtSeptember(){ return Lemma::txt([__FUNCTION__
		,en=>"September"
		,fr=>"septembre"
		,el=>"Σεπτέμβριος"
		]);}
	public static function txtOctober(){ return Lemma::txt([__FUNCTION__
		,en=>"October"
		,fr=>"octobre"
		,el=>"Οκτώβριος"
		]);}
	public static function txtNovember(){ return Lemma::txt([__FUNCTION__
		,en=>"November"
		,fr=>"novembre"
		,el=>"Νοέμβριος"
		]);}
	public static function txtDecember(){ return Lemma::txt([__FUNCTION__
		,en=>"December"
		,fr=>"décembre"
		,el=>"Δεκέμβριος"
		]);}

	public static function txtJan_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jan"
		,fr=>"jan."
		,el=>"Ιαν."
		]);}
	public static function txtFeb_(){ return Lemma::txt([__FUNCTION__
		,en=>"Feb"
		,fr=>"fév."
		,el=>"Φεβ."
		]);}
	public static function txtMar_(){ return Lemma::txt([__FUNCTION__
		,en=>"Mar"
		,fr=>"mars"
		,el=>"Μάρ."
		]);}
	public static function txtApr_(){ return Lemma::txt([__FUNCTION__
		,en=>"Apr"
		,fr=>"avr."
		,el=>"Απρ."
		]);}
	public static function txtMay_(){ return Lemma::txt([__FUNCTION__
		,en=>"May"
		,fr=>"mai"
		,el=>"Μάι."
		]);}
	public static function txtJun_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jun"
		,fr=>"juin"
		,el=>"Ιούν."
		]);}
	public static function txtJul_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jul"
		,fr=>"juil"
		,el=>"Ιούλ."
		]);}
	public static function txtAug_(){ return Lemma::txt([__FUNCTION__
		,en=>"Aug"
		,fr=>"août"
		,el=>"Αύγ."
		]);}
	public static function txtSep_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sep"
		,fr=>"sep."
		,el=>"Σεπ."
		]);}
	public static function txtOct_(){ return Lemma::txt([__FUNCTION__
		,en=>"Oct"
		,fr=>"oct."
		,el=>"Οκτ."
		]);}
	public static function txtNov_(){ return Lemma::txt([__FUNCTION__
		,en=>"Nov"
		,fr=>"nov."
		,el=>"Νοέ."
		]);}
	public static function txtDec_(){ return Lemma::txt([__FUNCTION__
		,en=>"Dec"
		,fr=>"déc."
		,el=>"Δεκ."
		]);}

	public static function txtMonday(){ return Lemma::txt([__FUNCTION__
		,en=>"Monday"
		,fr=>"lundi"
		,el=>"Δευτέρα"
		]);}
	public static function txtTuesday(){ return Lemma::txt([__FUNCTION__
		,en=>"Tuesday"
		,fr=>"mardi"
		,el=>"Τρίτη"
		]);}
	public static function txtWednesday(){ return Lemma::txt([__FUNCTION__
		,en=>"Wednesday"
		,fr=>"mercredi"
		,el=>"Τετάρτη"
		]);}
	public static function txtThursday(){ return Lemma::txt([__FUNCTION__
		,en=>"Thursday"
		,fr=>"jeudi"
		,el=>"Πέμπτη"
		]);}
	public static function txtFriday(){ return Lemma::txt([__FUNCTION__
		,en=>"Friday"
		,fr=>"vendredi"
		,el=>"Παρασκευή"
		]);}
	public static function txtSaturday(){ return Lemma::txt([__FUNCTION__
		,en=>"Saturday"
		,fr=>"samedi"
		,el=>"Σάββατο"
		]);}
	public static function txtSunday(){ return Lemma::txt([__FUNCTION__
		,en=>"Sunday"
		,fr=>"dimanche"
		,el=>"Κυριακή"
		]);}

	public static function txtMon_(){ return Lemma::txt([__FUNCTION__
		,en=>"Mon"
		,fr=>"lun."
		,el=>"Δευ."
		]);}
	public static function txtTue_(){ return Lemma::txt([__FUNCTION__
		,en=>"Tue"
		,fr=>"mar."
		,el=>"Τρί."
		]);}
	public static function txtWed_(){ return Lemma::txt([__FUNCTION__
		,en=>"Wed"
		,fr=>"mer."
		,el=>"Τετ."
		]);}
	public static function txtThu_(){ return Lemma::txt([__FUNCTION__
		,en=>"Thu"
		,fr=>"jeu."
		,el=>"Πέμ."
		]);}
	public static function txtFri_(){ return Lemma::txt([__FUNCTION__
		,en=>"Fri"
		,fr=>"ven."
		,el=>"Παρ."
		]);}
	public static function txtSat_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sat"
		,fr=>"sam."
		,el=>"Σάβ."
		]);}
	public static function txtSun_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sun"
		,fr=>"dim."
		,el=>"Κυρ."
		]);}





	public static function txtSubmit(){ return Lemma::txt([__FUNCTION__
		,en=>"Submit"
		,fr=>"Soumettre"
		,el=>"Αποστολή"
		]);}
	public static function txtLogin(){ return Lemma::txt([__FUNCTION__
		,en=>"Login"
		,fr=>"Connexion"
		,el=>"Login"
		]);}
	public static function txtLogoff(){ return Lemma::txt([__FUNCTION__
		,en=>"Logoff"
		,fr=>"Déconnexion"
		,el=>"Logoff"
		]);}
	public static function txtBack(){ return Lemma::txt([__FUNCTION__
		,en=>"Back"
		,fr=>"Retour"
		,el=>"Επιστροφή"
		]);}
	public static function txtOK(){ return Lemma::txt([__FUNCTION__
		,en=>"OK"
		,fr=>"OK"
		,el=>"OK"
		]);}
	public static function txtApply(){ return Lemma::txt([__FUNCTION__
		,en=>"Apply"
		,fr=>"Appliquer"
		,el=>"Εφαρμογή"
		]);}
	public static function txtCancel(){ return Lemma::txt([__FUNCTION__
		,en=>"Cancel"
		,fr=>"Annuler"
		,el=>"Άκυρο"
		]);}
	public static function txtSend(){ return Lemma::txt([__FUNCTION__
		,en=>"Send"
		,fr=>"Envoyer"
		,el=>"Αποστολή"
		]);}
	public static function txtSave(){ return Lemma::txt([__FUNCTION__
		,en=>"Save"
		,fr=>"Sauvegarder"
		,el=>"Αποθήκευση"
		]);}
	public static function txtDelete(){ return Lemma::txt([__FUNCTION__
		,en=>"Delete"
		,fr=>"Supprimer"
		,el=>"Διαγραφή"
		]);}
	public static function txtRename(){ return Lemma::txt([__FUNCTION__
		,en=>"Rename"
		,fr=>"Renommer"
		,el=>"Μετονομασία"
		]);}
	public static function txtPrint(){ return Lemma::txt([__FUNCTION__
		,en=>"Print"
		,fr=>"Imprimer"
		,el=>"Εκτύπωση"
		]);}
	public static function txtClose(){ return Lemma::txt([__FUNCTION__
		,en=>"Close"
		,fr=>"Fermer"
		,el=>"Κλείσιμο"
		]);}
	public static function txtAsk(){ return Lemma::txt([__FUNCTION__
		,en=>"Ask"
		,fr=>"Demander"
		,el=>"Ερώτηση"
		]);}
	public static function txtUpdate(){ return Lemma::txt([__FUNCTION__
		,en=>"Update"
		,fr=>"Mettre à jour"
		,el=>"Ανανέωση"
		]);}
	public static function txtSelect(){ return Lemma::txt([__FUNCTION__
		,en=>"Select"
		,fr=>"Sélectionner"
		,el=>"Επιλογή"
		]);}
	public static function txtCompare(){ return Lemma::txt([__FUNCTION__
		,en=>"Compare"
		,fr=>"Comparer"
		,el=>"Σύγκριση"
		]);}
	public static function txtSearch(){ return Lemma::txt([__FUNCTION__
		,en=>"Search"
		,fr=>"Rechercher"
		,el=>"Αναζήτηση"
		]);}
	public static function txtYes(){ return Lemma::txt([__FUNCTION__
		,en=>"Yes"
		,fr=>"Oui"
		,el=>"Ναι"
		]);}
	public static function txtNo(){ return Lemma::txt([__FUNCTION__
		,en=>"No"
		,fr=>"Non"
		,el=>"Όχι"
		]);}
	public static function txtNext(){ return Lemma::txt([__FUNCTION__
		,en=>"Next"
		,fr=>"Suivant"
		,el=>"Επόμενο"
		]);}
	public static function txtPrevious(){ return Lemma::txt([__FUNCTION__
		,en=>"Previous"
		,fr=>"Précédent"
		,el=>"Προηγούμενο"
		]);}
	public static function txtModify(){ return Lemma::txt([__FUNCTION__
		,en=>"Modify"
		,fr=>"Modifier"
		,el=>"Επεξεργασία"
		]);}
	public static function txtContinue(){ return Lemma::txt([__FUNCTION__
		,en=>"Continue"
		,fr=>"Continuer"
		,el=>"Συνέχεια"
		]);}

	public static function txtHome(){ return Lemma::txt([__FUNCTION__
		,en=>"Home"
		,fr=>"Accueil"
		,el=>"Αρχική"
		]);}
	public static function txtSettings(){ return Lemma::txt([__FUNCTION__
		,en=>"Settings"
		,fr=>"Paramètres"
		,el=>"Ρυθμίσεις"
		]);}


	public static function txtUser(){ return Lemma::txt([__FUNCTION__
		,en=>"User"
		,fr=>"Utilisateur"
		,el=>"Χρήστης"
		]);}
	public static function txtUsers(){ return Lemma::txt([__FUNCTION__
		,en=>"Users"
		,fr=>"Utilisateurs"
		,el=>"Χρήστες"
		]);}
	public static function txtChangePassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Change password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		]);}
	public static function txtResetPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		]);}
	public static function txtResetPasswordLong(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset password"
		,fr=>"Réinitialiser le mot de passe"
		,el=>"Αλλαγή κωδικού"
		]);}
	public static function txtReset(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset"
		,fr=>"Réinitialiser"
		,el=>"Αλλαγή"
		]);}
	public static function txtChangeProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Change profile"
		,fr=>"Profil"
		,el=>"Αλλαγή προφίλ"
		]);}
	public static function txtModifyProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Modify profile"
		,fr=>"Modifier profil"
		,el=>"Αλλαγή προφίλ"
		]);}

	public static function txtError(){ return Lemma::txt([__FUNCTION__
		,en=>"Error"
		,fr=>"Erreur"
		,el=>"Σφάλμα"
		]);}

	public static function txtActionLogin(){ return Lemma::txt([__FUNCTION__
		,en=>"Login"
		,fr=>"Connexion"
		,el=>"Login"
		]);}
	public static function txtActionLogoff(){ return Lemma::txt([__FUNCTION__
		,en=>"Logoff"
		,fr=>"Déconnexion"
		,el=>"Logoff"
		]);}
	public static function txtActionChangePassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Change password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		]);}
	public static function txtActionChangeProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Change profile"
		,fr=>"Profil d'utilisateur"
		,el=>"Προφίλ χρήστη"
		]);}
	public static function txtActionCreateUser(){ return Lemma::txt([__FUNCTION__
		,en=>"Create user"
		,fr=>"Création d'un utilisateur"
		,el=>"Δημιουργία χρήστη"
		]);}
	public static function txtActionForgottenPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Forgotten your password?"
		,fr=>"Mot de passe oublié ?"
		,el=>"Υπενθύμιση κωδικού"
		]);}

	public static function txtMsgCannotDisplayWebPage(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot display the web page."
		,fr=>"La page ne peut pas être affichée."
		]);}
	public static function txtMsgUnderConstruction(){ return Lemma::txt([__FUNCTION__
		,en=>"Under construction."
		,fr=>"En construction."
		,el=>"Υπό κατασκευή."
		]);}
	public static function txtMsgNotImplemented(){ return Lemma::txt([__FUNCTION__
		,en=>"Not implemented."
		,fr=>"Non implémenté."
		,el=>"Μη υλοποιημένο."
		]);}
	public static function txtMsgPageNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Page not found."
		,fr=>"La page n'était pas trouvée."
		,el=>"Η σελίδα δεν βρέθηκε."
		]);}
	public static function txtMsgObjectNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Object not found."
		,fr=>"L'objet n'était pas trouvé."
		,el=>"Το αντικείμενο δεν βρέθηκε."
		]);}
	public static function txtMsgAccessDenied(){ return Lemma::txt([__FUNCTION__
		,en=>"Access denied."
		,fr=>"Accès refusé."
		,el=>"Μη επιτρεπτή πρόσβαση."
		]);}
	public static function txtMsgInvalidUsername(){ return Lemma::txt([__FUNCTION__
		,en=>"Unknown user."
		,fr=>"Utilisateur inconnu."
		,el=>"Λάθος όνομα χρήστη."
		]);}
	public static function txtMsgInvalidPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid password."
		,fr=>"Mot de passe incorrect."
		,el=>"Λάθος κωδικός πρόσβασης."
		]);}
	public static function txtMsgInvalidUsernameOrPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid username or password."
		,fr=>"Utilisateur inconnu ou mot de passe incorrect."
		,el=>"Λάθος όνομα χρήστη ή λάθος κωδικός πρόσβασης."
		]);}
	public static function txtMsgMultipleUsersFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Multiple users found."
		,fr=>"Plusieurs utilisateurs trouvés."
		,el=>"Βρέθηκαν πολλαπλοί χρήστες."
		]);}
	public static function txtMsgEmailSentSuccessfully(){ return Lemma::txt([__FUNCTION__
		,en=>"The e-mail has been sent successfully."
		,fr=>"Le message e-mail a été bien envoyé."
		,el=>"Η αποστολή του e-mail έγινε επιτυχώς."
		]);}
	public static function txtMsgInvalidEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid e-mail address."
		,fr=>"L'adresse e-mail n'est pas valide."
		,el=>"Λάθος διεύθυνση e-mail."
		]);}
	public static function txtMsgInvalidPhone(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid phone number. Please use international format (+123456789)."
		,fr=>"Le numéro n'est pas valide. Veuillez utilisez le format international (+123456789)."
		,el=>"Λάθος αριθμός τηλεφώνου. Χρησιμοποιήστε το διεθνές πρότυπο (+123456789)."
		]);}
	public static function txtMsgInvalidURL(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid address."
		,fr=>"L'adresse n'est pas valide."
		,el=>"Λάθος διεύθυνση."
		]);}
	public static function txtMsgInvalidValue(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid value."
		,fr=>"Le valeur n'est pas valide."
		,el=>"Λάθος τιμή."
		]);}

	public static function txtMsgAccountBanned(){ return Lemma::txt([__FUNCTION__
		,en=>"User account locked."
		,fr=>"Compte utilisateur bloqué."
		,el=>"Kλειδωμένος λογαριασμός χρήστη."
		]);}

	public static function txtMsgPasswordsDoNotMatch(){ return Lemma::txt([__FUNCTION__
		,en=>"The passwords do not match."
		,fr=>"Les deux mots de passe ne sont pas identiques."
		,el=>"Οι κωδικοί δεν είναι ίδιοι."
		]);}

	public static function txtMsgMandatoryFields(){ return Lemma::txt([__FUNCTION__
		,en=>"The fields with * are mandatory."
		,fr=>"Les champs avec * sont obligatoires."
		,el=>"Τα πεδία με * είναι υποχρεωτικά."
		]);}

	public static function txtMsgMandatoryField(){ return Lemma::txt([__FUNCTION__
		,en=>"This field is mandatory."
		,fr=>"Ce champ est obligatoire."
		,el=>"Το πεδίο αυτό είναι υποχρεωτικό."
		]);}

	public static function txtMsgFieldMandatoryInAllLanguages(){ return Lemma::txt([__FUNCTION__
		,en=>"This field is mandatory in all languages."
		,fr=>"Ce champ est obligatoire en toutes les langues."
		,el=>"Το πεδίο αυτό είναι υποχρεωτικό σε όλες τις γλώσσες."
		]);}

	public static function txtMsgPasswordChanged(){ return Lemma::txt([__FUNCTION__
		,en=>"The password has been changed."
		,fr=>"Le mot de passe a été changé."
		,el=>"Ο κωδικός πρόσβασης άλλαξε."
		]);}

	public static function txtMsgProfileChanged(){ return Lemma::txt([__FUNCTION__
		,en=>"The user profile has been changed."
		,fr=>"Le profil de l'utilisateur a été changé."
		,el=>"Το προφίλ χρήστη άλλαξε."
		]);}

	public static function txtMsgUsernameExists(){ return Lemma::txt([__FUNCTION__
		,en=>"This username already exists."
		,fr=>"Cet utilisateur existe déjà."
		,el=>"Αυτό το όνομα χρήστη υπάρχει ήδη."
		]);}

	public static function txtMsgCannotSendEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while sending e-mail."
		,fr=>"Erreur lors de l'envoi d'e-mail."
		,el=>"Σφάλμα κατά την αποστολή e-mail."
		]);}

	public static function txtMsgCannotConnectToDatabase(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while connecting to the database."
		,fr=>"Erreur lors de la connexion à la base de données."
		,el=>"Σφάλμα κατά την σύνδεση με τη βάση δεδομένων."
		]);}
	public static function txtMsgCannotCreateDatabase(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while creating database schema."
		,fr=>"Erreur lors de la création de la base de données."
		,el=>"Σφάλμα κατά την δημιουργία νέας βάσης δεδομένων."
		]);}

	public static function txtMsgCannotDeleteCurrentUser(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot delete current user."
		,fr=>"Il est impossible de supprimer l'utilisateur courant."
		,el=>"Δεν είναι δυνατό να διαγραφεί ο τρέχον χρήστης."
		]);}

	public static function txtMsgObjectXNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"This object was not found: %s."
		,fr=>"Objet non trouvé : %s."
		,el=>"Το αντικείμενο αυτό δεν βρέθηκε: [%s]."
		]);}
	public static function txtMsgObjectXAlreadyExists(){ return Lemma::txt([__FUNCTION__
		,en=>"This object already exists: %s."
		,fr=>"Cet objet existe déjà : %s."
		,el=>"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		]);}
	public static function txtMsgCannotDeleteSystemObject(){ return Lemma::txt([__FUNCTION__
		,en=>"This object is used by the system."
		,fr=>"Cet objet est utilisé par le système."
		,el=>"Το αντικείμενο είναι απαραίτητο για την ομαλή λειτουργεία του συστήματος."
		]);}


	public static function txtMsgXItemNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"This object was not found [%s %s]."
		,fr=>"Objet non trouvé [%s %s]."
		,el=>"Το αντικείμενο αυτό δεν βρέθηκε: [%s %s]."
		]);}
	public static function txtMsgXItemAlreadyExists(){ return Lemma::txt([__FUNCTION__
		,fr=>"Cet objet existe déjà: %s."
		,en=>"This object already exists: %s."
		,el=>"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		]);}

	public static function txtMsgCancelling(){ return Lemma::txt([__FUNCTION__
		,en=>"Cancelling..."
		,fr=>"Annulation..."
		,el=>"Ακύρωση..."
		]);}
	public static function txtMsgProgressCancelled(){ return Lemma::txt([__FUNCTION__
		,en=>"The process has been cancelled."
		,fr=>"Le processus a été annulé."
		,el=>"Η διαδικασία ακυρώθηκε."
		]);}
	public static function txtMsgProgressCompleted(){ return Lemma::txt([__FUNCTION__
		,en=>"The process is completed."
		,fr=>"Le processus est terminé."
		,el=>"Η διαδικασία ολοκληρώθηκε."
		]);}
	public static function txtMsgNoObjectFound(){ return Lemma::txt([__FUNCTION__
		,en=>"No object found."
		,fr=>"Pas d'objet trouvé."
		,el=>"Δε βρέθηκε κανένα αντικείμενο."
		]);}
	public static function txtMsgInvalidAction(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid action."
		,fr=>"Action invalide."
		,el=>"Εσφαλμένη εντολή."
		]);}

	public static function txtMsgCannotConnectToLdapServer(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot connect to the database."
		,fr=>"Erreur à la connexion à la base de données."
		,el=>"Σφάλμα σύνδεσης με την βάση δεδομένων."
		]);}


	public static function txtMsgDevelopmentEnvironment(){ return Lemma::txt([__FUNCTION__
		,en=>"You are viewing this message because the application runs in DEVELOPMENT mode."
		,fr=>"Ce message s'affiche parce que l'application est en mode DEVELOPPEMENT."
		,el=>"Το μήνυμα αυτό εμφανίζεται γιατί η εφαρμογή τρέχει σε περιβάλλον ανάπτυξης."
		]);}
	public static function txtMsgAnErrorOccurred(){ return Lemma::txt([__FUNCTION__
		,en=>"An unexpected server error has occurred."
		,fr=>"Il y avait une erreur inattendue."
		,el=>"Προέκυψε ένα σφάλμα στον διακομιστή."
		]);}
	public static function txtMsgAnErrorOccurredAndTeamNotified(){ return Lemma::txt([__FUNCTION__
		,en=>"An unexpected server error has occurred. The support team has been notified."
		,fr=>"Il y avait une erreur inattendue. L'équipe de support vient d'en être notifié."
		,el=>"Προέκυψε ένα σφάλμα στον διακομιστή. Η ομάδα υποστήριξης ειδοποιήθηκε."
		]);}


	public static function txtMsgErrorWhileUploadingFile(){ return Lemma::txt([__FUNCTION__
		,en=>"An error occurred while uploading file."
		,fr=>"Erreur pendant l'envoi du fichier."
		,el=>"Σφάλμα κατά την αποστολή του αρχείου."
		]);}

	public static function txtMsgErrorWhileDownloadingFile(){ return Lemma::txt([__FUNCTION__
		,en=>"An error occurred while downloading file."
		,fr=>"Erreur pendant le téléchargement du fichier."
		,el=>"Σφάλμα κατά την λήψη του αρχείου."
		]);}
	public static function txtMsgUnsavedChanges(){ return Lemma::txt([__FUNCTION__
		,en=>"There are unsaved changes."
		,fr=>"Il y a des changements qui ne sont pas sauvegardés."
		,el=>"Υπάρχουν μη αποθηκευμένες αλλαγές."
		]);}



	public static function txtUnit_byte(){ return Lemma::txt([__FUNCTION__
		,en=>"B"
		,fr=>"o"
		,el=>"B"
		]);}
	public static function txtUnit_sec(){ return Lemma::txt([__FUNCTION__
		,en=>"sec"
		,fr=>"sec"
		,el=>"sec"
		]);}
	public static function txtUnit_day(){ return Lemma::txt([__FUNCTION__
		,en=>"d"
		,fr=>"j"
		,el=>"ημ"
		]);}
	public static function txtUnit_hour(){ return Lemma::txt([__FUNCTION__
		,en=>"h"
		,fr=>"h"
		,el=>"ώρ"
		]);}


	public static function txtLang_($x){ return static::txt(__FUNCTION__,$x); }
	public static function txtLang_en(){ return Lemma::txt([__FUNCTION__
		,en=>"English"
		,fr=>"Anglais"
		,el=>"Αγγλικά"
		]);}
	public static function txtLang_fr(){ return Lemma::txt([__FUNCTION__
		,en=>"French"
		,fr=>"Français"
		,el=>"Γαλλικά"
		]);}
	public static function txtLang_el(){ return Lemma::txt([__FUNCTION__
		,en=>"Greek"
		,fr=>"Grec"
		,el=>"Ελληνικά"
		]);}
	public static function txtLang_ar(){ return Lemma::txt([__FUNCTION__
		,en=>"Arabic"
		,fr=>"Arabic"
		]);}
	public static function txtLang_de(){ return Lemma::txt([__FUNCTION__
		,en=>"German"
		,fr=>"Allemand"
		]);}
	public static function txtLang_es(){ return Lemma::txt([__FUNCTION__
		,en=>"Spanish"
		,fr=>"Espagnol"
		]);}
	public static function txtLang_it(){ return Lemma::txt([__FUNCTION__
		,en=>"Italian"
		,fr=>"Italien"
		]);}
	public static function txtLang_fi(){ return Lemma::txt([__FUNCTION__
		,en=>"Finnish"
		,fr=>"Finnois"
		]);}
	public static function txtLang_ja(){ return Lemma::txt([__FUNCTION__
		,en=>"Japanese"
		,fr=>"Japonais"
		]);}
	public static function txtLang_ko(){ return Lemma::txt([__FUNCTION__
		,en=>"Korean"
		,fr=>"Coréen"
		]);}
	public static function txtLang_nl(){ return Lemma::txt([__FUNCTION__
		,en=>"Dutch"
		,fr=>"Néerlandais"
		]);}
	public static function txtLang_no(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian"
		,fr=>"Norvégien"
		]);}
	public static function txtLang_pl(){ return Lemma::txt([__FUNCTION__
		,en=>"Polish"
		,fr=>"Polonais"
		]);}
	public static function txtLang_pt(){ return Lemma::txt([__FUNCTION__
		,en=>"Portuguese"
		,fr=>"Portugais"
		]);}
	public static function txtLang_ru(){ return Lemma::txt([__FUNCTION__
		,en=>"Russian"
		,fr=>"Russe"
		]);}
	public static function txtLang_sv(){ return Lemma::txt([__FUNCTION__
		,en=>"Swedish"
		,fr=>"Suédois"
		]);}
	public static function txtLang_zh(){ return Lemma::txt([__FUNCTION__
		,en=>"Chinese"
		,fr=>"Chinois"
		]);}

	public static function txtLang_ab(){ return Lemma::txt([__FUNCTION__
		,en=>"Abkhaz"
		]);}
	public static function txtLang_aa(){ return Lemma::txt([__FUNCTION__
		,en=>"Afar"
		]);}
	public static function txtLang_af(){ return Lemma::txt([__FUNCTION__
		,en=>"Afrikaans"
		]);}
	public static function txtLang_ak(){ return Lemma::txt([__FUNCTION__
		,en=>"Akan"
		]);}
	public static function txtLang_sq(){ return Lemma::txt([__FUNCTION__
		,en=>"Albanian"
		]);}
	public static function txtLang_am(){ return Lemma::txt([__FUNCTION__
		,en=>"Amharic"
		]);}
	public static function txtLang_an(){ return Lemma::txt([__FUNCTION__
		,en=>"Aragonese"
		]);}
	public static function txtLang_hy(){ return Lemma::txt([__FUNCTION__
		,en=>"Armenian"
		]);}
	public static function txtLang_as(){ return Lemma::txt([__FUNCTION__
		,en=>"Assamese"
		]);}
	public static function txtLang_av(){ return Lemma::txt([__FUNCTION__
		,en=>"Avaric"
		]);}
	public static function txtLang_ae(){ return Lemma::txt([__FUNCTION__
		,en=>"Avestan"
		]);}
	public static function txtLang_ay(){ return Lemma::txt([__FUNCTION__
		,en=>"Aymara"
		]);}
	public static function txtLang_az(){ return Lemma::txt([__FUNCTION__
		,en=>"Azerbaijani"
		]);}
	public static function txtLang_bm(){ return Lemma::txt([__FUNCTION__
		,en=>"Bambara"
		]);}
	public static function txtLang_ba(){ return Lemma::txt([__FUNCTION__
		,en=>"Bashkir"
		]);}
	public static function txtLang_eu(){ return Lemma::txt([__FUNCTION__
		,en=>"Basque"
		]);}
	public static function txtLang_be(){ return Lemma::txt([__FUNCTION__
		,en=>"Belarusian"
		]);}
	public static function txtLang_bn(){ return Lemma::txt([__FUNCTION__
		,en=>"Bengali"
		]);}
	public static function txtLang_bh(){ return Lemma::txt([__FUNCTION__
		,en=>"Bihari"
		]);}
	public static function txtLang_bi(){ return Lemma::txt([__FUNCTION__
		,en=>"Bislama"
		]);}
	public static function txtLang_bs(){ return Lemma::txt([__FUNCTION__
		,en=>"Bosnian"
		]);}
	public static function txtLang_br(){ return Lemma::txt([__FUNCTION__
		,en=>"Breton"
		]);}
	public static function txtLang_bg(){ return Lemma::txt([__FUNCTION__
		,en=>"Bulgarian"
		]);}
	public static function txtLang_my(){ return Lemma::txt([__FUNCTION__
		,en=>"Burmese"
		]);}
	public static function txtLang_ca(){ return Lemma::txt([__FUNCTION__
		,en=>"Catalan"
		]);}
	public static function txtLang_ch(){ return Lemma::txt([__FUNCTION__
		,en=>"Chamorro"
		]);}
	public static function txtLang_ce(){ return Lemma::txt([__FUNCTION__
		,en=>"Chechen"
		]);}
	public static function txtLang_ny(){ return Lemma::txt([__FUNCTION__
		,en=>"Chichewa"
		]);}
	public static function txtLang_cv(){ return Lemma::txt([__FUNCTION__
		,en=>"Chuvash"
		]);}
	public static function txtLang_kw(){ return Lemma::txt([__FUNCTION__
		,en=>"Cornish"
		]);}
	public static function txtLang_co(){ return Lemma::txt([__FUNCTION__
		,en=>"Corsican"
		]);}
	public static function txtLang_cr(){ return Lemma::txt([__FUNCTION__
		,en=>"Cree"
		]);}
	public static function txtLang_hr(){ return Lemma::txt([__FUNCTION__
		,en=>"Croatian"
		]);}
	public static function txtLang_cs(){ return Lemma::txt([__FUNCTION__
		,en=>"Czech"
		]);}
	public static function txtLang_da(){ return Lemma::txt([__FUNCTION__
		,en=>"Danish"
		]);}
	public static function txtLang_dv(){ return Lemma::txt([__FUNCTION__
		,en=>"Divehi"
		]);}
	public static function txtLang_dz(){ return Lemma::txt([__FUNCTION__
		,en=>"Dzongkha"
		]);}
	public static function txtLang_eo(){ return Lemma::txt([__FUNCTION__
		,en=>"Esperanto"
		]);}
	public static function txtLang_et(){ return Lemma::txt([__FUNCTION__
		,en=>"Estonian"
		]);}
	public static function txtLang_ee(){ return Lemma::txt([__FUNCTION__
		,en=>"Ewe"
		]);}
	public static function txtLang_fo(){ return Lemma::txt([__FUNCTION__
		,en=>"Faroese"
		]);}
	public static function txtLang_fj(){ return Lemma::txt([__FUNCTION__
		,en=>"Fijian"
		]);}
	public static function txtLang_ff(){ return Lemma::txt([__FUNCTION__
		,en=>"Fula"
		]);}
	public static function txtLang_gl(){ return Lemma::txt([__FUNCTION__
		,en=>"Galician"
		]);}
	public static function txtLang_ka(){ return Lemma::txt([__FUNCTION__
		,en=>"Georgian"
		]);}
	public static function txtLang_gn(){ return Lemma::txt([__FUNCTION__
		,en=>"Guaraní"
		]);}
	public static function txtLang_gu(){ return Lemma::txt([__FUNCTION__
		,en=>"Gujarati"
		]);}
	public static function txtLang_ht(){ return Lemma::txt([__FUNCTION__
		,en=>"Haitian"
		]);}
	public static function txtLang_ha(){ return Lemma::txt([__FUNCTION__
		,en=>"Hausa"
		]);}
	public static function txtLang_he(){ return Lemma::txt([__FUNCTION__
		,en=>"Hebrew"
		]);}
	public static function txtLang_hz(){ return Lemma::txt([__FUNCTION__
		,en=>"Herero"
		]);}
	public static function txtLang_hi(){ return Lemma::txt([__FUNCTION__
		,en=>"Hindi"
		]);}
	public static function txtLang_ho(){ return Lemma::txt([__FUNCTION__
		,en=>"Hiri Motu"
		]);}
	public static function txtLang_hu(){ return Lemma::txt([__FUNCTION__
		,en=>"Hungarian"
		]);}
	public static function txtLang_ia(){ return Lemma::txt([__FUNCTION__
		,en=>"Interlingua"
		]);}
	public static function txtLang_id(){ return Lemma::txt([__FUNCTION__
		,en=>"Indonesian"
		]);}
	public static function txtLang_ie(){ return Lemma::txt([__FUNCTION__
		,en=>"Interlingue"
		]);}
	public static function txtLang_ga(){ return Lemma::txt([__FUNCTION__
		,en=>"Irish"
		]);}
	public static function txtLang_ig(){ return Lemma::txt([__FUNCTION__
		,en=>"Igbo"
		]);}
	public static function txtLang_ik(){ return Lemma::txt([__FUNCTION__
		,en=>"Inupiaq"
		]);}
	public static function txtLang_io(){ return Lemma::txt([__FUNCTION__
		,en=>"Ido"
		]);}
	public static function txtLang_is(){ return Lemma::txt([__FUNCTION__
		,en=>"Icelandic"
		]);}
	public static function txtLang_iu(){ return Lemma::txt([__FUNCTION__
		,en=>"Inuktitut"
		]);}
	public static function txtLang_jv(){ return Lemma::txt([__FUNCTION__
		,en=>"Javanese"
		]);}
	public static function txtLang_kl(){ return Lemma::txt([__FUNCTION__
		,en=>"Kalaallisut"
		]);}
	public static function txtLang_kn(){ return Lemma::txt([__FUNCTION__
		,en=>"Kannada"
		]);}
	public static function txtLang_kr(){ return Lemma::txt([__FUNCTION__
		,en=>"Kanuri"
		]);}
	public static function txtLang_ks(){ return Lemma::txt([__FUNCTION__
		,en=>"Kashmiri"
		]);}
	public static function txtLang_kk(){ return Lemma::txt([__FUNCTION__
		,en=>"Kazakh"
		]);}
	public static function txtLang_km(){ return Lemma::txt([__FUNCTION__
		,en=>"Khmer"
		]);}
	public static function txtLang_ki(){ return Lemma::txt([__FUNCTION__
		,en=>"Kikuyu"
		]);}
	public static function txtLang_rw(){ return Lemma::txt([__FUNCTION__
		,en=>"Kinyarwanda"
		]);}
	public static function txtLang_ky(){ return Lemma::txt([__FUNCTION__
		,en=>"Kyrgyz"
		]);}
	public static function txtLang_kv(){ return Lemma::txt([__FUNCTION__
		,en=>"Komi"
		]);}
	public static function txtLang_kg(){ return Lemma::txt([__FUNCTION__
		,en=>"Kongo"
		]);}
	public static function txtLang_ku(){ return Lemma::txt([__FUNCTION__
		,en=>"Kurdish"
		]);}
	public static function txtLang_kj(){ return Lemma::txt([__FUNCTION__
		,en=>"Kwanyama"
		]);}
	public static function txtLang_la(){ return Lemma::txt([__FUNCTION__
		,en=>"Latin"
		]);}
	public static function txtLang_lb(){ return Lemma::txt([__FUNCTION__
		,en=>"Luxembourgish"
		]);}
	public static function txtLang_lg(){ return Lemma::txt([__FUNCTION__
		,en=>"Ganda"
		]);}
	public static function txtLang_li(){ return Lemma::txt([__FUNCTION__
		,en=>"Limburgish"
		]);}
	public static function txtLang_ln(){ return Lemma::txt([__FUNCTION__
		,en=>"Lingala"
		]);}
	public static function txtLang_lo(){ return Lemma::txt([__FUNCTION__
		,en=>"Lao"
		]);}
	public static function txtLang_lt(){ return Lemma::txt([__FUNCTION__
		,en=>"Lithuanian"
		]);}
	public static function txtLang_lu(){ return Lemma::txt([__FUNCTION__
		,en=>"Luba-Katanga"
		]);}
	public static function txtLang_lv(){ return Lemma::txt([__FUNCTION__
		,en=>"Latvian"
		]);}
	public static function txtLang_gv(){ return Lemma::txt([__FUNCTION__
		,en=>"Manx"
		]);}
	public static function txtLang_mk(){ return Lemma::txt([__FUNCTION__
		,en=>"Macedonian"
		]);}
	public static function txtLang_mg(){ return Lemma::txt([__FUNCTION__
		,en=>"Malagasy"
		]);}
	public static function txtLang_ms(){ return Lemma::txt([__FUNCTION__
		,en=>"Malay"
		]);}
	public static function txtLang_ml(){ return Lemma::txt([__FUNCTION__
		,en=>"Malayalam"
		]);}
	public static function txtLang_mt(){ return Lemma::txt([__FUNCTION__
		,en=>"Maltese"
		]);}
	public static function txtLang_mi(){ return Lemma::txt([__FUNCTION__
		,en=>"Māori"
		]);}
	public static function txtLang_mr(){ return Lemma::txt([__FUNCTION__
		,en=>"Marathi"
		]);}
	public static function txtLang_mh(){ return Lemma::txt([__FUNCTION__
		,en=>"Marshallese"
		]);}
	public static function txtLang_mn(){ return Lemma::txt([__FUNCTION__
		,en=>"Mongolian"
		]);}
	public static function txtLang_na(){ return Lemma::txt([__FUNCTION__
		,en=>"Nauru"
		]);}
	public static function txtLang_nv(){ return Lemma::txt([__FUNCTION__
		,en=>"Navajo"
		]);}
	public static function txtLang_nb(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian Bokmål"
		]);}
	public static function txtLang_nd(){ return Lemma::txt([__FUNCTION__
		,en=>"North Ndebele"
		]);}
	public static function txtLang_ne(){ return Lemma::txt([__FUNCTION__
		,en=>"Nepali"
		]);}
	public static function txtLang_ng(){ return Lemma::txt([__FUNCTION__
		,en=>"Ndonga"
		]);}
	public static function txtLang_nn(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian Nynorsk"
		]);}
	public static function txtLang_ii(){ return Lemma::txt([__FUNCTION__
		,en=>"Nuosu"
		]);}
	public static function txtLang_nr(){ return Lemma::txt([__FUNCTION__
		,en=>"South Ndebele"
		]);}
	public static function txtLang_oc(){ return Lemma::txt([__FUNCTION__
		,en=>"Occitan"
		]);}
	public static function txtLang_oj(){ return Lemma::txt([__FUNCTION__
		,en=>"Ojibwe"
		]);}
	public static function txtLang_cu(){ return Lemma::txt([__FUNCTION__
		,en=>"Old Slavonic"
		]);}
	public static function txtLang_om(){ return Lemma::txt([__FUNCTION__
		,en=>"Oromo"
		]);}
	public static function txtLang_or(){ return Lemma::txt([__FUNCTION__
		,en=>"Oriya"
		]);}
	public static function txtLang_os(){ return Lemma::txt([__FUNCTION__
		,en=>"Ossetian"
		]);}
	public static function txtLang_pa(){ return Lemma::txt([__FUNCTION__
		,en=>"Panjabi"
		]);}
	public static function txtLang_pi(){ return Lemma::txt([__FUNCTION__
		,en=>"Pāli"
		]);}
	public static function txtLang_fa(){ return Lemma::txt([__FUNCTION__
		,en=>"Farsi"
		]);}
	public static function txtLang_ps(){ return Lemma::txt([__FUNCTION__
		,en=>"Pashto"
		]);}
	public static function txtLang_qu(){ return Lemma::txt([__FUNCTION__
		,en=>"Quechua"
		]);}
	public static function txtLang_rm(){ return Lemma::txt([__FUNCTION__
		,en=>"Romansh"
		]);}
	public static function txtLang_rn(){ return Lemma::txt([__FUNCTION__
		,en=>"Kirundi"
		]);}
	public static function txtLang_ro(){ return Lemma::txt([__FUNCTION__
		,en=>"Romanian"
		]);}
	public static function txtLang_sa(){ return Lemma::txt([__FUNCTION__
		,en=>"Sanskrit"
		]);}
	public static function txtLang_sc(){ return Lemma::txt([__FUNCTION__
		,en=>"Sardinian"
		]);}
	public static function txtLang_sd(){ return Lemma::txt([__FUNCTION__
		,en=>"Sindhi"
		]);}
	public static function txtLang_se(){ return Lemma::txt([__FUNCTION__
		,en=>"Northern Sami"
		]);}
	public static function txtLang_sm(){ return Lemma::txt([__FUNCTION__
		,en=>"Samoan"
		]);}
	public static function txtLang_sg(){ return Lemma::txt([__FUNCTION__
		,en=>"Sango"
		]);}
	public static function txtLang_sr(){ return Lemma::txt([__FUNCTION__
		,en=>"Serbian"
		]);}
	public static function txtLang_gd(){ return Lemma::txt([__FUNCTION__
		,en=>"Scottish Gaelic"
		]);}
	public static function txtLang_sn(){ return Lemma::txt([__FUNCTION__
		,en=>"Shona"
		]);}
	public static function txtLang_si(){ return Lemma::txt([__FUNCTION__
		,en=>"Sinhala"
		]);}
	public static function txtLang_sk(){ return Lemma::txt([__FUNCTION__
		,en=>"Slovak"
		]);}
	public static function txtLang_sl(){ return Lemma::txt([__FUNCTION__
		,en=>"Slovene"
		]);}
	public static function txtLang_so(){ return Lemma::txt([__FUNCTION__
		,en=>"Somali"
		]);}
	public static function txtLang_st(){ return Lemma::txt([__FUNCTION__
		,en=>"Southern Sotho"
		]);}
	public static function txtLang_su(){ return Lemma::txt([__FUNCTION__
		,en=>"Sundanese"
		]);}
	public static function txtLang_sw(){ return Lemma::txt([__FUNCTION__
		,en=>"Swahili"
		]);}
	public static function txtLang_ss(){ return Lemma::txt([__FUNCTION__
		,en=>"Swati"
		]);}
	public static function txtLang_ta(){ return Lemma::txt([__FUNCTION__
		,en=>"Tamil"
		]);}
	public static function txtLang_te(){ return Lemma::txt([__FUNCTION__
		,en=>"Telugu"
		]);}
	public static function txtLang_tg(){ return Lemma::txt([__FUNCTION__
		,en=>"Tajik"
		]);}
	public static function txtLang_th(){ return Lemma::txt([__FUNCTION__
		,en=>"Thai"
		]);}
	public static function txtLang_ti(){ return Lemma::txt([__FUNCTION__
		,en=>"Tigrinya"
		]);}
	public static function txtLang_bo(){ return Lemma::txt([__FUNCTION__
		,en=>"Tibetan"
		]);}
	public static function txtLang_tk(){ return Lemma::txt([__FUNCTION__
		,en=>"Turkmen"
		]);}
	public static function txtLang_tl(){ return Lemma::txt([__FUNCTION__
		,en=>"Tagalog"
		]);}
	public static function txtLang_tn(){ return Lemma::txt([__FUNCTION__
		,en=>"Tswana"
		]);}
	public static function txtLang_to(){ return Lemma::txt([__FUNCTION__
		,en=>"Tonga"
		]);}
	public static function txtLang_tr(){ return Lemma::txt([__FUNCTION__
		,en=>"Turkish"
		]);}
	public static function txtLang_ts(){ return Lemma::txt([__FUNCTION__
		,en=>"Tsonga"
		]);}
	public static function txtLang_tt(){ return Lemma::txt([__FUNCTION__
		,en=>"Tatar"
		]);}
	public static function txtLang_tw(){ return Lemma::txt([__FUNCTION__
		,en=>"Twi"
		]);}
	public static function txtLang_ty(){ return Lemma::txt([__FUNCTION__
		,en=>"Tahitian"
		]);}
	public static function txtLang_ug(){ return Lemma::txt([__FUNCTION__
		,en=>"Uyghur"
		]);}
	public static function txtLang_uk(){ return Lemma::txt([__FUNCTION__
		,en=>"Ukrainian"
		]);}
	public static function txtLang_ur(){ return Lemma::txt([__FUNCTION__
		,en=>"Urdu"
		]);}
	public static function txtLang_uz(){ return Lemma::txt([__FUNCTION__
		,en=>"Uzbek"
		]);}
	public static function txtLang_ve(){ return Lemma::txt([__FUNCTION__
		,en=>"Venda"
		]);}
	public static function txtLang_vi(){ return Lemma::txt([__FUNCTION__
		,en=>"Vietnamese"
		]);}
	public static function txtLang_vo(){ return Lemma::txt([__FUNCTION__
		,en=>"Volapük"
		]);}
	public static function txtLang_wa(){ return Lemma::txt([__FUNCTION__
		,en=>"Walloon"
		]);}
	public static function txtLang_cy(){ return Lemma::txt([__FUNCTION__
		,en=>"Welsh"
		]);}
	public static function txtLang_wo(){ return Lemma::txt([__FUNCTION__
		,en=>"Wolof"
		]);}
	public static function txtLang_fy(){ return Lemma::txt([__FUNCTION__
		,en=>"Western Frisian"
		]);}
	public static function txtLang_xh(){ return Lemma::txt([__FUNCTION__
		,en=>"Xhosa"
		]);}
	public static function txtLang_yi(){ return Lemma::txt([__FUNCTION__
		,en=>"Yiddish"
		]);}
	public static function txtLang_yo(){ return Lemma::txt([__FUNCTION__
		,en=>"Yoruba"
		]);}
	public static function txtLang_za(){ return Lemma::txt([__FUNCTION__
		,en=>"Zhuang"
		]);}
	public static function txtLang_zu(){ return Lemma::txt([__FUNCTION__
		,en=>"Zulu"
		]);}



	public static function txtCountry_($x) { return static::txt(__FUNCTION__,$x); }
	public static function txtCountry_AD(){ return Lemma::txt([__FUNCTION__
		,en=>"ANDORRA"
		,fr=>"ANDORRE"
		]);}
	public static function txtCountry_AE(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED ARAB EMIRATES"
		,fr=>"ÉMIRATS ARABES UNIS"
		]);}
	public static function txtCountry_AF(){ return Lemma::txt([__FUNCTION__
		,en=>"AFGHANISTAN"
		,fr=>"AFGHANISTAN"
		]);}
	public static function txtCountry_AG(){ return Lemma::txt([__FUNCTION__
		,en=>"ANTIGUA AND BARBUDA"
		,fr=>"ANTIGUA-ET-BARBUDA"
		]);}
	public static function txtCountry_AI(){ return Lemma::txt([__FUNCTION__
		,en=>"ANGUILLA"
		,fr=>"ANGUILLA"
		]);}
	public static function txtCountry_AL(){ return Lemma::txt([__FUNCTION__
		,en=>"ALBANIA"
		,fr=>"ALBANIE"
		]);}
	public static function txtCountry_AM(){ return Lemma::txt([__FUNCTION__
		,en=>"ARMENIA"
		,fr=>"ARMÉNIE"
		]);}
	public static function txtCountry_AO(){ return Lemma::txt([__FUNCTION__
		,en=>"ANGOLA"
		,fr=>"ANGOLA"
		]);}
	public static function txtCountry_AQ(){ return Lemma::txt([__FUNCTION__
		,en=>"ANTARCTICA"
		,fr=>"ANTARCTIQUE"
		]);}
	public static function txtCountry_AR(){ return Lemma::txt([__FUNCTION__
		,en=>"ARGENTINA"
		,fr=>"ARGENTINE"
		]);}
	public static function txtCountry_AS(){ return Lemma::txt([__FUNCTION__
		,en=>"AMERICAN SAMOA"
		,fr=>"SAMOA AMÉRICAINES"
		]);}
	public static function txtCountry_AT(){ return Lemma::txt([__FUNCTION__
		,en=>"AUSTRIA"
		,fr=>"AUTRICHE"
		]);}
	public static function txtCountry_AU(){ return Lemma::txt([__FUNCTION__
		,en=>"AUSTRALIA"
		,fr=>"AUSTRALIE"
		]);}
	public static function txtCountry_AW(){ return Lemma::txt([__FUNCTION__
		,en=>"ARUBA"
		,fr=>"ARUBA"
		]);}
	public static function txtCountry_AX(){ return Lemma::txt([__FUNCTION__
		,en=>"ÅLAND ISLANDS"
		,fr=>"ÅLAND, ÎLES"
		]);}
	public static function txtCountry_AZ(){ return Lemma::txt([__FUNCTION__
		,en=>"AZERBAIJAN"
		,fr=>"AZERBAÏDJAN"
		]);}
	public static function txtCountry_BA(){ return Lemma::txt([__FUNCTION__
		,en=>"BOSNIA AND HERZEGOVINA"
		,fr=>"BOSNIE-HERZÉGOVINE"
		]);}
	public static function txtCountry_BB(){ return Lemma::txt([__FUNCTION__
		,en=>"BARBADOS"
		,fr=>"BARBADE"
		]);}
	public static function txtCountry_BD(){ return Lemma::txt([__FUNCTION__
		,en=>"BANGLADESH"
		,fr=>"BANGLADESH"
		]);}
	public static function txtCountry_BE(){ return Lemma::txt([__FUNCTION__
		,en=>"BELGIUM"
		,fr=>"BELGIQUE"
		]);}
	public static function txtCountry_BF(){ return Lemma::txt([__FUNCTION__
		,en=>"BURKINA FASO"
		,fr=>"BURKINA FASO"
		]);}
	public static function txtCountry_BG(){ return Lemma::txt([__FUNCTION__
		,en=>"BULGARIA"
		,fr=>"BULGARIE"
		]);}
	public static function txtCountry_BH(){ return Lemma::txt([__FUNCTION__
		,en=>"BAHRAIN"
		,fr=>"BAHREÏN"
		]);}
	public static function txtCountry_BI(){ return Lemma::txt([__FUNCTION__
		,en=>"BURUNDI"
		,fr=>"BURUNDI"
		]);}
	public static function txtCountry_BJ(){ return Lemma::txt([__FUNCTION__
		,en=>"BENIN"
		,fr=>"BÉNIN"
		]);}
	public static function txtCountry_BL(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT BARTHÉLEMY"
		,fr=>"SAINT-BARTHÉLEMY"
		]);}
	public static function txtCountry_BM(){ return Lemma::txt([__FUNCTION__
		,en=>"BERMUDA"
		,fr=>"BERMUDES"
		]);}
	public static function txtCountry_BN(){ return Lemma::txt([__FUNCTION__
		,en=>"BRUNEI DARUSSALAM"
		,fr=>"BRUNÉI DARUSSALAM"
		]);}
	public static function txtCountry_BO(){ return Lemma::txt([__FUNCTION__
		,en=>"BOLIVIA, PLURINATIONAL STATE OF"
		,fr=>"BOLIVIE, L'ÉTAT PLURINATIONAL DE"
		]);}
	public static function txtCountry_BQ(){ return Lemma::txt([__FUNCTION__
		,en=>"BONAIRE, SAINT EUSTATIUS AND SABA"
		,fr=>"BONAIRE, SAINT-EUSTACHE ET SABA"
		]);}
	public static function txtCountry_BR(){ return Lemma::txt([__FUNCTION__
		,en=>"BRAZIL"
		,fr=>"BRÉSIL"
		]);}
	public static function txtCountry_BS(){ return Lemma::txt([__FUNCTION__
		,en=>"BAHAMAS"
		,fr=>"BAHAMAS"
		]);}
	public static function txtCountry_BT(){ return Lemma::txt([__FUNCTION__
		,en=>"BHUTAN"
		,fr=>"BHOUTAN"
		]);}
	public static function txtCountry_BV(){ return Lemma::txt([__FUNCTION__
		,en=>"BOUVET ISLAND"
		,fr=>"BOUVET, ÎLE"
		]);}
	public static function txtCountry_BW(){ return Lemma::txt([__FUNCTION__
		,en=>"BOTSWANA"
		,fr=>"BOTSWANA"
		]);}
	public static function txtCountry_BY(){ return Lemma::txt([__FUNCTION__
		,en=>"BELARUS"
		,fr=>"BÉLARUS"
		]);}
	public static function txtCountry_BZ(){ return Lemma::txt([__FUNCTION__
		,en=>"BELIZE"
		,fr=>"BELIZE"
		]);}
	public static function txtCountry_CA(){ return Lemma::txt([__FUNCTION__
		,en=>"CANADA"
		,fr=>"CANADA"
		]);}
	public static function txtCountry_CC(){ return Lemma::txt([__FUNCTION__
		,en=>"COCOS (KEELING) ISLANDS"
		,fr=>"COCOS (KEELING), ÎLES"
		]);}
	public static function txtCountry_CD(){ return Lemma::txt([__FUNCTION__
		,en=>"CONGO, THE DEMOCRATIC REPUBLIC OF THE"
		,fr=>"CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU"
		]);}
	public static function txtCountry_CF(){ return Lemma::txt([__FUNCTION__
		,en=>"CENTRAL AFRICAN REPUBLIC"
		,fr=>"CENTRAFRICAINE, RÉPUBLIQUE"
		]);}
	public static function txtCountry_CG(){ return Lemma::txt([__FUNCTION__
		,en=>"CONGO"
		,fr=>"CONGO"
		]);}
	public static function txtCountry_CH(){ return Lemma::txt([__FUNCTION__
		,en=>"SWITZERLAND"
		,fr=>"SUISSE"
		]);}
	public static function txtCountry_CI(){ return Lemma::txt([__FUNCTION__
		,en=>"CÔTE D'IVOIRE"
		,fr=>"CÔTE D'IVOIRE"
		]);}
	public static function txtCountry_CK(){ return Lemma::txt([__FUNCTION__
		,en=>"COOK ISLANDS"
		,fr=>"COOK, ÎLES"
		]);}
	public static function txtCountry_CL(){ return Lemma::txt([__FUNCTION__
		,en=>"CHILE"
		,fr=>"CHILI"
		]);}
	public static function txtCountry_CM(){ return Lemma::txt([__FUNCTION__
		,en=>"CAMEROON"
		,fr=>"CAMEROUN"
		]);}
	public static function txtCountry_CN(){ return Lemma::txt([__FUNCTION__
		,en=>"CHINA"
		,fr=>"CHINE"
		]);}
	public static function txtCountry_CO(){ return Lemma::txt([__FUNCTION__
		,en=>"COLOMBIA"
		,fr=>"COLOMBIE"
		]);}
	public static function txtCountry_CR(){ return Lemma::txt([__FUNCTION__
		,en=>"COSTA RICA"
		,fr=>"COSTA RICA"
		]);}
	public static function txtCountry_CU(){ return Lemma::txt([__FUNCTION__
		,en=>"CUBA"
		,fr=>"CUBA"
		]);}
	public static function txtCountry_CV(){ return Lemma::txt([__FUNCTION__
		,en=>"CAPE VERDE"
		,fr=>"CAP-VERT"
		]);}
	public static function txtCountry_CW(){ return Lemma::txt([__FUNCTION__
		,en=>"CURAÇAO"
		,fr=>"CURAÇAO"
		]);}
	public static function txtCountry_CX(){ return Lemma::txt([__FUNCTION__
		,en=>"CHRISTMAS ISLAND"
		,fr=>"CHRISTMAS, ÎLE"
		]);}
	public static function txtCountry_CY(){ return Lemma::txt([__FUNCTION__
		,en=>"CYPRUS"
		,fr=>"CHYPRE"
		]);}
	public static function txtCountry_CZ(){ return Lemma::txt([__FUNCTION__
		,en=>"CZECH REPUBLIC"
		,fr=>"TCHÈQUE, RÉPUBLIQUE"
		]);}
	public static function txtCountry_DE(){ return Lemma::txt([__FUNCTION__
		,en=>"GERMANY"
		,fr=>"ALLEMAGNE"
		]);}
	public static function txtCountry_DJ(){ return Lemma::txt([__FUNCTION__
		,en=>"DJIBOUTI"
		,fr=>"DJIBOUTI"
		]);}
	public static function txtCountry_DK(){ return Lemma::txt([__FUNCTION__
		,en=>"DENMARK"
		,fr=>"DANEMARK"
		]);}
	public static function txtCountry_DM(){ return Lemma::txt([__FUNCTION__
		,en=>"DOMINICA"
		,fr=>"DOMINIQUE"
		]);}
	public static function txtCountry_DO(){ return Lemma::txt([__FUNCTION__
		,en=>"DOMINICAN REPUBLIC"
		,fr=>"DOMINICAINE, RÉPUBLIQUE"
		]);}
	public static function txtCountry_DZ(){ return Lemma::txt([__FUNCTION__
		,en=>"ALGERIA"
		,fr=>"ALGÉRIE"
		]);}
	public static function txtCountry_EC(){ return Lemma::txt([__FUNCTION__
		,en=>"ECUADOR"
		,fr=>"ÉQUATEUR"
		]);}
	public static function txtCountry_EE(){ return Lemma::txt([__FUNCTION__
		,en=>"ESTONIA"
		,fr=>"ESTONIE"
		]);}
	public static function txtCountry_EG(){ return Lemma::txt([__FUNCTION__
		,en=>"EGYPT"
		,fr=>"ÉGYPTE"
		]);}
	public static function txtCountry_EH(){ return Lemma::txt([__FUNCTION__
		,en=>"WESTERN SAHARA"
		,fr=>"SAHARA OCCIDENTAL"
		]);}
	public static function txtCountry_ER(){ return Lemma::txt([__FUNCTION__
		,en=>"ERITREA"
		,fr=>"ÉRYTHRÉE"
		]);}
	public static function txtCountry_ES(){ return Lemma::txt([__FUNCTION__
		,en=>"SPAIN"
		,fr=>"ESPAGNE"
		]);}
	public static function txtCountry_ET(){ return Lemma::txt([__FUNCTION__
		,en=>"ETHIOPIA"
		,fr=>"ÉTHIOPIE"
		]);}
	public static function txtCountry_FI(){ return Lemma::txt([__FUNCTION__
		,en=>"FINLAND"
		,fr=>"FINLANDE"
		]);}
	public static function txtCountry_FJ(){ return Lemma::txt([__FUNCTION__
		,en=>"FIJI"
		,fr=>"FIDJI"
		]);}
	public static function txtCountry_FK(){ return Lemma::txt([__FUNCTION__
		,en=>"FALKLAND ISLANDS (MALVINAS)"
		,fr=>"FALKLAND, ÎLES (MALVINAS)"
		]);}
	public static function txtCountry_FM(){ return Lemma::txt([__FUNCTION__
		,en=>"MICRONESIA, FEDERATED STATES OF"
		,fr=>"MICRONÉSIE, ÉTATS FÉDÉRÉS DE"
		]);}
	public static function txtCountry_FO(){ return Lemma::txt([__FUNCTION__
		,en=>"FAROE ISLANDS"
		,fr=>"FÉROÉ, ÎLES"
		]);}
	public static function txtCountry_FR(){ return Lemma::txt([__FUNCTION__
		,en=>"FRANCE"
		,fr=>"FRANCE"
		]);}
	public static function txtCountry_GA(){ return Lemma::txt([__FUNCTION__
		,en=>"GABON"
		,fr=>"GABON"
		]);}
	public static function txtCountry_GB(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED KINGDOM"
		,fr=>"ROYAUME-UNI"
		]);}
	public static function txtCountry_GD(){ return Lemma::txt([__FUNCTION__
		,en=>"GRENADA"
		,fr=>"GRENADE"
		]);}
	public static function txtCountry_GE(){ return Lemma::txt([__FUNCTION__
		,en=>"GEORGIA"
		,fr=>"GÉORGIE"
		]);}
	public static function txtCountry_GF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH GUIANA"
		,fr=>"GUYANE FRANÇAISE"
		]);}
	public static function txtCountry_GG(){ return Lemma::txt([__FUNCTION__
		,en=>"GUERNSEY"
		,fr=>"GUERNESEY"
		]);}
	public static function txtCountry_GH(){ return Lemma::txt([__FUNCTION__
		,en=>"GHANA"
		,fr=>"GHANA"
		]);}
	public static function txtCountry_GI(){ return Lemma::txt([__FUNCTION__
		,en=>"GIBRALTAR"
		,fr=>"GIBRALTAR"
		]);}
	public static function txtCountry_GL(){ return Lemma::txt([__FUNCTION__
		,en=>"GREENLAND"
		,fr=>"GROENLAND"
		]);}
	public static function txtCountry_GM(){ return Lemma::txt([__FUNCTION__
		,en=>"GAMBIA"
		,fr=>"GAMBIE"
		]);}
	public static function txtCountry_GN(){ return Lemma::txt([__FUNCTION__
		,en=>"GUINEA"
		,fr=>"GUINÉE"
		]);}
	public static function txtCountry_GP(){ return Lemma::txt([__FUNCTION__
		,en=>"GUADELOUPE"
		,fr=>"GUADELOUPE"
		]);}
	public static function txtCountry_GQ(){ return Lemma::txt([__FUNCTION__
		,en=>"EQUATORIAL GUINEA"
		,fr=>"GUINÉE ÉQUATORIALE"
		]);}
	public static function txtCountry_GR(){ return Lemma::txt([__FUNCTION__
		,en=>"GREECE"
		,fr=>"GRÈCE"
		]);}
	public static function txtCountry_GS(){ return Lemma::txt([__FUNCTION__
		,en=>"SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS"
		,fr=>"GÉORGIE DU SUD ET LES ÎLES SANDWICH DU SUD"
		]);}
	public static function txtCountry_GT(){ return Lemma::txt([__FUNCTION__
		,en=>"GUATEMALA"
		,fr=>"GUATEMALA"
		]);}
	public static function txtCountry_GU(){ return Lemma::txt([__FUNCTION__
		,en=>"GUAM"
		,fr=>"GUAM"
		]);}
	public static function txtCountry_GW(){ return Lemma::txt([__FUNCTION__
		,en=>"GUINEA-BISSAU"
		,fr=>"GUINÉE-BISSAU"
		]);}
	public static function txtCountry_GY(){ return Lemma::txt([__FUNCTION__
		,en=>"GUYANA"
		,fr=>"GUYANA"
		]);}
	public static function txtCountry_HK(){ return Lemma::txt([__FUNCTION__
		,en=>"HONG KONG"
		,fr=>"HONG-KONG"
		]);}
	public static function txtCountry_HM(){ return Lemma::txt([__FUNCTION__
		,en=>"HEARD ISLAND AND MCDONALD ISLANDS"
		,fr=>"HEARD, ÎLE ET MCDONALD, ÎLES"
		]);}
	public static function txtCountry_HN(){ return Lemma::txt([__FUNCTION__
		,en=>"HONDURAS"
		,fr=>"HONDURAS"
		]);}
	public static function txtCountry_HR(){ return Lemma::txt([__FUNCTION__
		,en=>"CROATIA"
		,fr=>"CROATIE"
		]);}
	public static function txtCountry_HT(){ return Lemma::txt([__FUNCTION__
		,en=>"HAITI"
		,fr=>"HAÏTI"
		]);}
	public static function txtCountry_HU(){ return Lemma::txt([__FUNCTION__
		,en=>"HUNGARY"
		,fr=>"HONGRIE"
		]);}
	public static function txtCountry_ID(){ return Lemma::txt([__FUNCTION__
		,en=>"INDONESIA"
		,fr=>"INDONÉSIE"
		]);}
	public static function txtCountry_IE(){ return Lemma::txt([__FUNCTION__
		,en=>"IRELAND"
		,fr=>"IRLANDE"
		]);}
	public static function txtCountry_IL(){ return Lemma::txt([__FUNCTION__
		,en=>"ISRAEL"
		,fr=>"ISRAËL"
		]);}
	public static function txtCountry_IM(){ return Lemma::txt([__FUNCTION__
		,en=>"ISLE OF MAN"
		,fr=>"ÎLE DE MAN"
		]);}
	public static function txtCountry_IN(){ return Lemma::txt([__FUNCTION__
		,en=>"INDIA"
		,fr=>"INDE"
		]);}
	public static function txtCountry_IO(){ return Lemma::txt([__FUNCTION__
		,en=>"BRITISH INDIAN OCEAN TERRITORY"
		,fr=>"OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L"
		]);}
	public static function txtCountry_IQ(){ return Lemma::txt([__FUNCTION__
		,en=>"IRAQ"
		,fr=>"IRAQ"
		]);}
	public static function txtCountry_IR(){ return Lemma::txt([__FUNCTION__
		,en=>"IRAN, ISLAMIC REPUBLIC OF"
		,fr=>"IRAN, RÉPUBLIQUE ISLAMIQUE D"
		]);}
	public static function txtCountry_IS(){ return Lemma::txt([__FUNCTION__
		,en=>"ICELAND"
		,fr=>"ISLANDE"
		]);}
	public static function txtCountry_IT(){ return Lemma::txt([__FUNCTION__
		,en=>"ITALY"
		,fr=>"ITALIE"
		]);}
	public static function txtCountry_JE(){ return Lemma::txt([__FUNCTION__
		,en=>"JERSEY"
		,fr=>"JERSEY"
		]);}
	public static function txtCountry_JM(){ return Lemma::txt([__FUNCTION__
		,en=>"JAMAICA"
		,fr=>"JAMAÏQUE"
		]);}
	public static function txtCountry_JO(){ return Lemma::txt([__FUNCTION__
		,en=>"JORDAN"
		,fr=>"JORDANIE"
		]);}
	public static function txtCountry_JP(){ return Lemma::txt([__FUNCTION__
		,en=>"JAPAN"
		,fr=>"JAPON"
		]);}
	public static function txtCountry_KE(){ return Lemma::txt([__FUNCTION__
		,en=>"KENYA"
		,fr=>"KENYA"
		]);}
	public static function txtCountry_KG(){ return Lemma::txt([__FUNCTION__
		,en=>"KYRGYZSTAN"
		,fr=>"KIRGHIZISTAN"
		]);}
	public static function txtCountry_KH(){ return Lemma::txt([__FUNCTION__
		,en=>"CAMBODIA"
		,fr=>"CAMBODGE"
		]);}
	public static function txtCountry_KI(){ return Lemma::txt([__FUNCTION__
		,en=>"KIRIBATI"
		,fr=>"KIRIBATI"
		]);}
	public static function txtCountry_KM(){ return Lemma::txt([__FUNCTION__
		,en=>"COMOROS"
		,fr=>"COMORES"
		]);}
	public static function txtCountry_KN(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT KITTS AND NEVIS"
		,fr=>"SAINT-KITTS-ET-NEVIS"
		]);}
	public static function txtCountry_KP(){ return Lemma::txt([__FUNCTION__
		,en=>"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF"
		,fr=>"CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE"
		]);}
	public static function txtCountry_KR(){ return Lemma::txt([__FUNCTION__
		,en=>"KOREA, REPUBLIC OF"
		,fr=>"CORÉE, RÉPUBLIQUE DE"
		]);}
	public static function txtCountry_KW(){ return Lemma::txt([__FUNCTION__
		,en=>"KUWAIT"
		,fr=>"KOWEÏT"
		]);}
	public static function txtCountry_KY(){ return Lemma::txt([__FUNCTION__
		,en=>"CAYMAN ISLANDS"
		,fr=>"CAÏMANES, ÎLES"
		]);}
	public static function txtCountry_KZ(){ return Lemma::txt([__FUNCTION__
		,en=>"KAZAKHSTAN"
		,fr=>"KAZAKHSTAN"
		]);}
	public static function txtCountry_LA(){ return Lemma::txt([__FUNCTION__
		,en=>"LAO PEOPLE'S DEMOCRATIC REPUBLIC"
		,fr=>"LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE"
		]);}
	public static function txtCountry_LB(){ return Lemma::txt([__FUNCTION__
		,en=>"LEBANON"
		,fr=>"LIBAN"
		]);}
	public static function txtCountry_LC(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT LUCIA"
		,fr=>"SAINTE-LUCIE"
		]);}
	public static function txtCountry_LI(){ return Lemma::txt([__FUNCTION__
		,en=>"LIECHTENSTEIN"
		,fr=>"LIECHTENSTEIN"
		]);}
	public static function txtCountry_LK(){ return Lemma::txt([__FUNCTION__
		,en=>"SRI LANKA"
		,fr=>"SRI LANKA"
		]);}
	public static function txtCountry_LR(){ return Lemma::txt([__FUNCTION__
		,en=>"LIBERIA"
		,fr=>"LIBÉRIA"
		]);}
	public static function txtCountry_LS(){ return Lemma::txt([__FUNCTION__
		,en=>"LESOTHO"
		,fr=>"LESOTHO"
		]);}
	public static function txtCountry_LT(){ return Lemma::txt([__FUNCTION__
		,en=>"LITHUANIA"
		,fr=>"LITUANIE"
		]);}
	public static function txtCountry_LU(){ return Lemma::txt([__FUNCTION__
		,en=>"LUXEMBOURG"
		,fr=>"LUXEMBOURG"
		]);}
	public static function txtCountry_LV(){ return Lemma::txt([__FUNCTION__
		,en=>"LATVIA"
		,fr=>"LETTONIE"
		]);}
	public static function txtCountry_LY(){ return Lemma::txt([__FUNCTION__
		,en=>"LIBYAN ARAB JAMAHIRIYA"
		,fr=>"LIBYENNE, JAMAHIRIYA ARABE"
		]);}
	public static function txtCountry_MA(){ return Lemma::txt([__FUNCTION__
		,en=>"MOROCCO"
		,fr=>"MAROC"
		]);}
	public static function txtCountry_MC(){ return Lemma::txt([__FUNCTION__
		,en=>"MONACO"
		,fr=>"MONACO"
		]);}
	public static function txtCountry_MD(){ return Lemma::txt([__FUNCTION__
		,en=>"MOLDOVA, REPUBLIC OF"
		,fr=>"MOLDOVA, RÉPUBLIQUE DE"
		]);}
	public static function txtCountry_ME(){ return Lemma::txt([__FUNCTION__
		,en=>"MONTENEGRO"
		,fr=>"MONTÉNÉGRO"
		]);}
	public static function txtCountry_MF(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT MARTIN (FRENCH PART)"
		,fr=>"SAINT-MARTIN(PARTIE FRANÇAISE)"
		]);}
	public static function txtCountry_MG(){ return Lemma::txt([__FUNCTION__
		,en=>"MADAGASCAR"
		,fr=>"MADAGASCAR"
		]);}
	public static function txtCountry_MH(){ return Lemma::txt([__FUNCTION__
		,en=>"MARSHALL ISLANDS"
		,fr=>"MARSHALL, ÎLES"
		]);}
	public static function txtCountry_MK(){ return Lemma::txt([__FUNCTION__
		,en=>"MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF"
		,fr=>"MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE"
		]);}
	public static function txtCountry_ML(){ return Lemma::txt([__FUNCTION__
		,en=>"MALI"
		,fr=>"MALI"
		]);}
	public static function txtCountry_MM(){ return Lemma::txt([__FUNCTION__
		,en=>"MYANMAR"
		,fr=>"MYANMAR"
		]);}
	public static function txtCountry_MN(){ return Lemma::txt([__FUNCTION__
		,en=>"MONGOLIA"
		,fr=>"MONGOLIE"
		]);}
	public static function txtCountry_MO(){ return Lemma::txt([__FUNCTION__
		,en=>"MACAO"
		,fr=>"MACAO"
		]);}
	public static function txtCountry_MP(){ return Lemma::txt([__FUNCTION__
		,en=>"NORTHERN MARIANA ISLANDS"
		,fr=>"MARIANNES DU NORD, ÎLES"
		]);}
	public static function txtCountry_MQ(){ return Lemma::txt([__FUNCTION__
		,en=>"MARTINIQUE"
		,fr=>"MARTINIQUE"
		]);}
	public static function txtCountry_MR(){ return Lemma::txt([__FUNCTION__
		,en=>"MAURITANIA"
		,fr=>"MAURITANIE"
		]);}
	public static function txtCountry_MS(){ return Lemma::txt([__FUNCTION__
		,en=>"MONTSERRAT"
		,fr=>"MONTSERRAT"
		]);}
	public static function txtCountry_MT(){ return Lemma::txt([__FUNCTION__
		,en=>"MALTA"
		,fr=>"MALTE"
		]);}
	public static function txtCountry_MU(){ return Lemma::txt([__FUNCTION__
		,en=>"MAURITIUS"
		,fr=>"MAURICE"
		]);}
	public static function txtCountry_MV(){ return Lemma::txt([__FUNCTION__
		,en=>"MALDIVES"
		,fr=>"MALDIVES"
		]);}
	public static function txtCountry_MW(){ return Lemma::txt([__FUNCTION__
		,en=>"MALAWI"
		,fr=>"MALAWI"
		]);}
	public static function txtCountry_MX(){ return Lemma::txt([__FUNCTION__
		,en=>"MEXICO"
		,fr=>"MEXIQUE"
		]);}
	public static function txtCountry_MY(){ return Lemma::txt([__FUNCTION__
		,en=>"MALAYSIA"
		,fr=>"MALAISIE"
		]);}
	public static function txtCountry_MZ(){ return Lemma::txt([__FUNCTION__
		,en=>"MOZAMBIQUE"
		,fr=>"MOZAMBIQUE"
		]);}
	public static function txtCountry_NA(){ return Lemma::txt([__FUNCTION__
		,en=>"NAMIBIA"
		,fr=>"NAMIBIE"
		]);}
	public static function txtCountry_NC(){ return Lemma::txt([__FUNCTION__
		,en=>"NEW CALEDONIA"
		,fr=>"NOUVELLE-CALÉDONIE"
		]);}
	public static function txtCountry_NE(){ return Lemma::txt([__FUNCTION__
		,en=>"NIGER"
		,fr=>"NIGER"
		]);}
	public static function txtCountry_NF(){ return Lemma::txt([__FUNCTION__
		,en=>"NORFOLK ISLAND"
		,fr=>"NORFOLK, ÎLE"
		]);}
	public static function txtCountry_NG(){ return Lemma::txt([__FUNCTION__
		,en=>"NIGERIA"
		,fr=>"NIGÉRIA"
		]);}
	public static function txtCountry_NI(){ return Lemma::txt([__FUNCTION__
		,en=>"NICARAGUA"
		,fr=>"NICARAGUA"
		]);}
	public static function txtCountry_NL(){ return Lemma::txt([__FUNCTION__
		,en=>"NETHERLANDS"
		,fr=>"PAYS-BAS"
		]);}
	public static function txtCountry_NO(){ return Lemma::txt([__FUNCTION__
		,en=>"NORWAY"
		,fr=>"NORVÈGE"
		]);}
	public static function txtCountry_NP(){ return Lemma::txt([__FUNCTION__
		,en=>"NEPAL"
		,fr=>"NÉPAL"
		]);}
	public static function txtCountry_NR(){ return Lemma::txt([__FUNCTION__
		,en=>"NAURU"
		,fr=>"NAURU"
		]);}
	public static function txtCountry_NU(){ return Lemma::txt([__FUNCTION__
		,en=>"NIUE"
		,fr=>"NIUÉ"
		]);}
	public static function txtCountry_NZ(){ return Lemma::txt([__FUNCTION__
		,en=>"NEW ZEALAND"
		,fr=>"NOUVELLE-ZÉLANDE"
		]);}
	public static function txtCountry_OM(){ return Lemma::txt([__FUNCTION__
		,en=>"OMAN"
		,fr=>"OMAN"
		]);}
	public static function txtCountry_PA(){ return Lemma::txt([__FUNCTION__
		,en=>"PANAMA"
		,fr=>"PANAMA"
		]);}
	public static function txtCountry_PE(){ return Lemma::txt([__FUNCTION__
		,en=>"PERU"
		,fr=>"PÉROU"
		]);}
	public static function txtCountry_PF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH POLYNESIA"
		,fr=>"POLYNÉSIE FRANÇAISE"
		]);}
	public static function txtCountry_PG(){ return Lemma::txt([__FUNCTION__
		,en=>"PAPUA NEW GUINEA"
		,fr=>"PAPOUASIE-NOUVELLE-GUINÉE"
		]);}
	public static function txtCountry_PH(){ return Lemma::txt([__FUNCTION__
		,en=>"PHILIPPINES"
		,fr=>"PHILIPPINES"
		]);}
	public static function txtCountry_PK(){ return Lemma::txt([__FUNCTION__
		,en=>"PAKISTAN"
		,fr=>"PAKISTAN"
		]);}
	public static function txtCountry_PL(){ return Lemma::txt([__FUNCTION__
		,en=>"POLAND"
		,fr=>"POLOGNE"
		]);}
	public static function txtCountry_PM(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT PIERRE AND MIQUELON"
		,fr=>"SAINT-PIERRE-ET-MIQUELON"
		]);}
	public static function txtCountry_PN(){ return Lemma::txt([__FUNCTION__
		,en=>"PITCAIRN"
		,fr=>"PITCAIRN"
		]);}
	public static function txtCountry_PR(){ return Lemma::txt([__FUNCTION__
		,en=>"PUERTO RICO"
		,fr=>"PORTO RICO"
		]);}
	public static function txtCountry_PS(){ return Lemma::txt([__FUNCTION__
		,en=>"PALESTINIAN TERRITORY, OCCUPIED"
		,fr=>"PALESTINIEN OCCUPÉ, TERRITOIRE"
		]);}
	public static function txtCountry_PT(){ return Lemma::txt([__FUNCTION__
		,en=>"PORTUGAL"
		,fr=>"PORTUGAL"
		]);}
	public static function txtCountry_PW(){ return Lemma::txt([__FUNCTION__
		,en=>"PALAU"
		,fr=>"PALAOS"
		]);}
	public static function txtCountry_PY(){ return Lemma::txt([__FUNCTION__
		,en=>"PARAGUAY"
		,fr=>"PARAGUAY"
		]);}
	public static function txtCountry_QA(){ return Lemma::txt([__FUNCTION__
		,en=>"QATAR"
		,fr=>"QATAR"
		]);}
	public static function txtCountry_RE(){ return Lemma::txt([__FUNCTION__
		,en=>"RÉUNION"
		,fr=>"RÉUNION"
		]);}
	public static function txtCountry_RO(){ return Lemma::txt([__FUNCTION__
		,en=>"ROMANIA"
		,fr=>"ROUMANIE"
		]);}
	public static function txtCountry_RS(){ return Lemma::txt([__FUNCTION__
		,en=>"SERBIA"
		,fr=>"SERBIE"
		]);}
	public static function txtCountry_RU(){ return Lemma::txt([__FUNCTION__
		,en=>"RUSSIAN FEDERATION"
		,fr=>"RUSSIE, FÉDÉRATION DE"
		]);}
	public static function txtCountry_RW(){ return Lemma::txt([__FUNCTION__
		,en=>"RWANDA"
		,fr=>"RWANDA"
		]);}
	public static function txtCountry_SA(){ return Lemma::txt([__FUNCTION__
		,en=>"SAUDI ARABIA"
		,fr=>"ARABIE SAOUDITE"
		]);}
	public static function txtCountry_SB(){ return Lemma::txt([__FUNCTION__
		,en=>"SOLOMON ISLANDS"
		,fr=>"SALOMON, ÎLES"
		]);}
	public static function txtCountry_SC(){ return Lemma::txt([__FUNCTION__
		,en=>"SEYCHELLES"
		,fr=>"SEYCHELLES"
		]);}
	public static function txtCountry_SD(){ return Lemma::txt([__FUNCTION__
		,en=>"SUDAN"
		,fr=>"SOUDAN"
		]);}
	public static function txtCountry_SE(){ return Lemma::txt([__FUNCTION__
		,en=>"SWEDEN"
		,fr=>"SUÈDE"
		]);}
	public static function txtCountry_SG(){ return Lemma::txt([__FUNCTION__
		,en=>"SINGAPORE"
		,fr=>"SINGAPOUR"
		]);}
	public static function txtCountry_SH(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA"
		,fr=>"SAINTE-HÉLÈNE, ASCENSION ET TRISTAN DA CUNHA"
		]);}
	public static function txtCountry_SI(){ return Lemma::txt([__FUNCTION__
		,en=>"SLOVENIA"
		,fr=>"SLOVÉNIE"
		]);}
	public static function txtCountry_SJ(){ return Lemma::txt([__FUNCTION__
		,en=>"SVALBARD AND JAN MAYEN"
		,fr=>"SVALBARD ET ÎLE JAN MAYEN"
		]);}
	public static function txtCountry_SK(){ return Lemma::txt([__FUNCTION__
		,en=>"SLOVAKIA"
		,fr=>"SLOVAQUIE"
		]);}
	public static function txtCountry_SL(){ return Lemma::txt([__FUNCTION__
		,en=>"SIERRA LEONE"
		,fr=>"SIERRA LEONE"
		]);}
	public static function txtCountry_SM(){ return Lemma::txt([__FUNCTION__
		,en=>"SAN MARINO"
		,fr=>"SAINT-MARIN"
		]);}
	public static function txtCountry_SN(){ return Lemma::txt([__FUNCTION__
		,en=>"SENEGAL"
		,fr=>"SÉNÉGAL"
		]);}
	public static function txtCountry_SO(){ return Lemma::txt([__FUNCTION__
		,en=>"SOMALIA"
		,fr=>"SOMALIE"
		]);}
	public static function txtCountry_SR(){ return Lemma::txt([__FUNCTION__
		,en=>"SURINAME"
		,fr=>"SURINAME"
		]);}
	public static function txtCountry_ST(){ return Lemma::txt([__FUNCTION__
		,en=>"SAO TOME AND PRINCIPE"
		,fr=>"SAO TOMÉ-ET-PRINCIPE"
		]);}
	public static function txtCountry_SV(){ return Lemma::txt([__FUNCTION__
		,en=>"EL SALVADOR"
		,fr=>"EL SALVADOR"
		]);}
	public static function txtCountry_SX(){ return Lemma::txt([__FUNCTION__
		,en=>"SINT MAARTEN (DUTCH PART)"
		,fr=>"SAINT-MARTIN (PARTIE NÉERLANDAISE)"
		]);}
	public static function txtCountry_SY(){ return Lemma::txt([__FUNCTION__
		,en=>"SYRIAN ARAB REPUBLIC"
		,fr=>"SYRIENNE, RÉPUBLIQUE ARABE"
		]);}
	public static function txtCountry_SZ(){ return Lemma::txt([__FUNCTION__
		,en=>"SWAZILAND"
		,fr=>"SWAZILAND"
		]);}
	public static function txtCountry_TC(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKS AND CAICOS ISLANDS"
		,fr=>"TURKS ET CAÏQUES, ÎLES"
		]);}
	public static function txtCountry_TD(){ return Lemma::txt([__FUNCTION__
		,en=>"CHAD"
		,fr=>"TCHAD"
		]);}
	public static function txtCountry_TF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH SOUTHERN TERRITORIES"
		,fr=>"TERRES AUSTRALES FRANÇAISES"
		]);}
	public static function txtCountry_TG(){ return Lemma::txt([__FUNCTION__
		,en=>"TOGO"
		,fr=>"TOGO"
		]);}
	public static function txtCountry_TH(){ return Lemma::txt([__FUNCTION__
		,en=>"THAILAND"
		,fr=>"THAÏLANDE"
		]);}
	public static function txtCountry_TJ(){ return Lemma::txt([__FUNCTION__
		,en=>"TAJIKISTAN"
		,fr=>"TADJIKISTAN"
		]);}
	public static function txtCountry_TK(){ return Lemma::txt([__FUNCTION__
		,en=>"TOKELAU"
		,fr=>"TOKELAU"
		]);}
	public static function txtCountry_TL(){ return Lemma::txt([__FUNCTION__
		,en=>"TIMOR-LESTE"
		,fr=>"TIMOR-LESTE"
		]);}
	public static function txtCountry_TM(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKMENISTAN"
		,fr=>"TURKMÉNISTAN"
		]);}
	public static function txtCountry_TN(){ return Lemma::txt([__FUNCTION__
		,en=>"TUNISIA"
		,fr=>"TUNISIE"
		]);}
	public static function txtCountry_TO(){ return Lemma::txt([__FUNCTION__
		,en=>"TONGA"
		,fr=>"TONGA"
		]);}
	public static function txtCountry_TR(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKEY"
		,fr=>"TURQUIE"
		]);}
	public static function txtCountry_TT(){ return Lemma::txt([__FUNCTION__
		,en=>"TRINIDAD AND TOBAGO"
		,fr=>"TRINITÉ-ET-TOBAGO"
		]);}
	public static function txtCountry_TV(){ return Lemma::txt([__FUNCTION__
		,en=>"TUVALU"
		,fr=>"TUVALU"
		]);}
	public static function txtCountry_TW(){ return Lemma::txt([__FUNCTION__
		,en=>"TAIWAN, PROVINCE OF CHINA"
		,fr=>"TAÏWAN, PROVINCE DE CHINE"
		]);}
	public static function txtCountry_TZ(){ return Lemma::txt([__FUNCTION__
		,en=>"TANZANIA, UNITED REPUBLIC OF"
		,fr=>"TANZANIE, RÉPUBLIQUE-UNIE DE"
		]);}
	public static function txtCountry_UA(){ return Lemma::txt([__FUNCTION__
		,en=>"UKRAINE"
		,fr=>"UKRAINE"
		]);}
	public static function txtCountry_UG(){ return Lemma::txt([__FUNCTION__
		,en=>"UGANDA"
		,fr=>"OUGANDA"
		]);}
	public static function txtCountry_UM(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED STATES MINOR OUTLYING ISLANDS"
		,fr=>"ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS"
		]);}
	public static function txtCountry_US(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED STATES"
		,fr=>"ÉTATS-UNIS"
		]);}
	public static function txtCountry_UY(){ return Lemma::txt([__FUNCTION__
		,en=>"URUGUAY"
		,fr=>"URUGUAY"
		]);}
	public static function txtCountry_UZ(){ return Lemma::txt([__FUNCTION__
		,en=>"UZBEKISTAN"
		,fr=>"OUZBÉKISTAN"
		]);}
	public static function txtCountry_VA(){ return Lemma::txt([__FUNCTION__
		,en=>"HOLY SEE (VATICAN CITY STATE)"
		,fr=>"SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)"
		]);}
	public static function txtCountry_VC(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT VINCENT AND THE GRENADINES"
		,fr=>"SAINT-VINCENT-ET-LES GRENADINES"
		]);}
	public static function txtCountry_VE(){ return Lemma::txt([__FUNCTION__
		,en=>"VENEZUELA, BOLIVARIAN REPUBLIC OF"
		,fr=>"VENEZUELA, RÉPUBLIQUE BOLIVARIENNE DU"
		]);}
	public static function txtCountry_VG(){ return Lemma::txt([__FUNCTION__
		,en=>"VIRGIN ISLANDS, BRITISH"
		,fr=>"ÎLES VIERGES BRITANNIQUES"
		]);}
	public static function txtCountry_VI(){ return Lemma::txt([__FUNCTION__
		,en=>"VIRGIN ISLANDS, U.S."
		,fr=>"ÎLES VIERGES DES ÉTATS-UNIS"
		]);}
	public static function txtCountry_VN(){ return Lemma::txt([__FUNCTION__
		,en=>"VIET NAM"
		,fr=>"VIET NAM"
		]);}
	public static function txtCountry_VU(){ return Lemma::txt([__FUNCTION__
		,en=>"VANUATU"
		,fr=>"VANUATU"
		]);}
	public static function txtCountry_WF(){ return Lemma::txt([__FUNCTION__
		,en=>"WALLIS AND FUTUNA"
		,fr=>"WALLIS ET FUTUNA"
		]);}
	public static function txtCountry_WS(){ return Lemma::txt([__FUNCTION__
		,en=>"SAMOA"
		,fr=>"SAMOA"
		]);}
	public static function txtCountry_YE(){ return Lemma::txt([__FUNCTION__
		,en=>"YEMEN"
		,fr=>"YÉMEN"
		]);}
	public static function txtCountry_YT(){ return Lemma::txt([__FUNCTION__
		,en=>"MAYOTTE"
		,fr=>"MAYOTTE"
		]);}
	public static function txtCountry_ZA(){ return Lemma::txt([__FUNCTION__
		,en=>"SOUTH AFRICA"
		,fr=>"AFRIQUE DU SUD"
		]);}
	public static function txtCountry_ZM(){ return Lemma::txt([__FUNCTION__
		,en=>"ZAMBIA"
		,fr=>"ZAMBIE"
		]);}
	public static function txtCountry_ZW(){ return Lemma::txt([__FUNCTION__
		,en=>"ZIMBABWE"
		,fr=>"ZIMBABWE"
		]);}

}

