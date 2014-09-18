<?php

abstract class _oxy_dictionary {
	//protected static function _() { list(,$caller) = debug_backtrace(false); return new Lemma($caller); }
	///** @return Lemma */ protected static function __($x) { list(,$caller) = debug_backtrace(false); return forward_static_call([get_called_class(),$caller.'_'.$x]); }

	/** @return Lemma */ public static function txt($n){
		$c = get_called_class();
		$n = 'txt'.$n;
		if (method_exists($c,$n))
			return call_user_func([$c,$n]);
		else
			return new Lemma($n);
	}
	/** @return Lemma */ protected static function _forward() {
		$c = get_called_class();
		list(,$n) = debug_backtrace(false);
		$n = $n['function'].implode('_',func_get_args());
		if (method_exists($c,$n))
			return call_user_func([$c,$n]);
		else
			return new Lemma($n);
	}



	public static function txten(){ return new Lemma(__FUNCTION__
		,'en',"English"
		,'fr',"Anglais"
		,'el',"Αγγλικά"
		);}
	public static function txtfr(){ return new Lemma(__FUNCTION__
		,'en',"French"
		,'fr',"Français"
		,'el',"Γαλλικά"
		);}
	public static function txtel(){ return new Lemma(__FUNCTION__
		,'en',"Greek"
		,'fr',"Grec"
		,'el',"Ελληνικά"
		);}
	public static function txt_locale(){ return new Lemma(__FUNCTION__
		,'en',"en_GB"
		,'fr',"fr_FR"
		,'el',"el_GR"
		);}
	public static function txt_thousands_separator(){ return new Lemma(__FUNCTION__
		,'en',","
		,'fr'," "
		,'el',"."
		);}
	public static function txt_decimal_separator(){ return new Lemma(__FUNCTION__
		,'en',"."
		,'fr',","
		,'el',","
		);}

	public static function txtLanguage(){ return new Lemma(__FUNCTION__
		,'en',"Language"
		,'fr',"Langue"
		,'el',"Γλώσσα"
		);}
	public static function txtName(){ return new Lemma(__FUNCTION__
		,'en',"Name"
		,'fr',"Nom"
		,'el',"Όνομα"
		);}
	public static function txtSurname(){ return new Lemma(__FUNCTION__
		,'en',"Surname"
		,'fr',"Nom"
		,'el',"Επίθετο"
		);}
	public static function txtFirstName(){ return new Lemma(__FUNCTION__
		,'en',"Name"
		,'fr',"Prénom"
		,'el',"Όνομα"
		);}
	public static function txtCompany(){ return new Lemma(__FUNCTION__
		,'en',"Company"
		,'fr',"Société"
		,'el',"Εταιρία"
		);}
	public static function txtPosition(){ return new Lemma(__FUNCTION__
		,'en',"Position"
		,'fr',"Position"
		,'el',"Θέση"
		);}
	public static function txtGender(){ return new Lemma(__FUNCTION__
		,'en',"Gender"
		,'fr',"Sexe"
		,'el',"Φύλο"
		);}
	public static function txtMale(){ return new Lemma(__FUNCTION__
		,'en',"Male"
		,'fr',"Homme"
		,'el',"Άρρεν"
		);}
	public static function txtFemale(){ return new Lemma(__FUNCTION__
		,'en',"Female"
		,'fr',"Femme"
		,'el',"Θύλη"
		);}
	public static function txtPhone(){ return new Lemma(__FUNCTION__
		,'en',"Phone"
		,'fr',"Téléphone"
		,'el',"Τηλέφωνο"
		);}
	public static function txtEmail(){ return new Lemma(__FUNCTION__
		,'en',"E-mail"
		,'fr',"E-mail"
		,'el',"E-mail"
		);}
	public static function txtAddress(){ return new Lemma(__FUNCTION__
		,'en',"Address"
		,'fr',"Adresse"
		,'el',"Διεύθυνση"
		);}
	public static function txtCity(){ return new Lemma(__FUNCTION__
		,'en',"City"
		,'fr',"Ville"
		,'el',"Πόλη"
		);}
	public static function txtZip(){ return new Lemma(__FUNCTION__
		,'en',"Postal code"
		,'fr',"Code postal"
		,'el',"Τ.Κ."
		);}
	public static function txtCountry(){ return new Lemma(__FUNCTION__
		,'en',"Country"
		,'fr',"Pays"
		,'el',"Χώρα"
		);}
	public static function txtComments(){ return new Lemma(__FUNCTION__
		,'en',"Comments"
		,'fr',"Commentaires"
		,'el',"Σχόλια"
		);}
	public static function txtUsername(){ return new Lemma(__FUNCTION__
		,'en',"Username"
		,'fr',"Identifiant"
		,'el',"Username"
		);}
	public static function txtPassword(){ return new Lemma(__FUNCTION__
		,'en',"Password"
		,'fr',"Mot de passe"
		,'el',"Κωδικός"
		);}
	public static function txtOldPassword(){ return new Lemma(__FUNCTION__
		,'en',"Old password"
		,'fr',"Ancien mot de passe"
		,'el',"Παλιός κωδικός"
		);}
	public static function txtNewPassword(){ return new Lemma(__FUNCTION__
		,'en',"New password"
		,'fr',"Nouveau mot de passe"
		,'el',"Νέος κωδικός"
		);}
	public static function txtConfirmPassword(){ return new Lemma(__FUNCTION__
		,'en',"Confirm"
		,'fr',"Confirmer"
		,'el',"Επιβεβαίωση"
		);}
	public static function txtDateCreated(){ return new Lemma(__FUNCTION__
		,'en',"Date created"
		,'fr',"Date de création"
		,'el',"Ημ.δημιουργίας"
		);}
	public static function txtDateModified(){ return new Lemma(__FUNCTION__
		,'en',"Date modified"
		,'fr',"Date de modification"
		,'el',"Ημ.μεταβολής"
		);}
	public static function txtEmailRcpt(){ return new Lemma(__FUNCTION__
		,'en',"To"
		,'fr',"A"
		,'el',"Πρoς"
		);}
	public static function txtEmailSubject(){ return new Lemma(__FUNCTION__
		,'en',"Subject"
		,'fr',"Sujet"
		,'el',"Θέμα"
		);}
	public static function txtEmailBody(){ return new Lemma(__FUNCTION__
		,'en',"Body"
		,'fr',"Message"
		,'el',"Κείμενο"
		);}
	public static function txtEmailFrom(){ return new Lemma(__FUNCTION__
		,'en',"From"
		,'fr',"De"
		,'el',"Από"
		);}
	public static function txtDateSent(){ return new Lemma(__FUNCTION__
		,'en',"Date sent"
		,'fr',"Date d'envoi"
		,'el',"Ημ.αποστολής"
		);}
	public static function txtLockedAccount(){ return new Lemma(__FUNCTION__
		,'en',"Locked account"
		,'fr',"Compte bloqué"
		,'el',"Κλειδωμένος λογαριασμός"
		);}
	public static function txtFile(){ return new Lemma(__FUNCTION__
		,'en',"File"
		,'fr',"Fichier"
		,'el',"Αρχείο"
		);}



	public static function txtDate(){ return new Lemma(__FUNCTION__
		,'en',"Date"
		,'fr',"Date"
		,'el',"Ημερομηνία"
		);}
	public static function txtTime(){ return new Lemma(__FUNCTION__
		,'en',"Time"
		,'fr',"Heure"
		,'el',"Ώρα"
		);}
	public static function txtToday(){ return new Lemma(__FUNCTION__
		,'en',"Today"
		,'fr',"Aujourd'hui"
		,'el',"Σήμερα"
		);}
	public static function txtTomorrow(){ return new Lemma(__FUNCTION__
		,'en',"Tomorrow"
		,'fr',"Demain"
		,'el',"Αύριο"
		);}
	public static function txtYesterday(){ return new Lemma(__FUNCTION__
		,'en',"Yesterday"
		,'fr',"Hier"
		,'el',"Xθες"
		);}
	public static function txtNow(){ return new Lemma(__FUNCTION__
		,'en',"Now"
		,'fr',"Maintenant"
		,'el',"Τώρα"
		);}
	public static function txtAM(){ return new Lemma(__FUNCTION__
		,'en',"a.m."
		,'fr',"avant-midi"
		,'el',"π.μ."
		);}
	public static function txtPM(){ return new Lemma(__FUNCTION__
		,'en',"p.m."
		,'fr',"après-midi"
		,'el',"μ.μ."
		);}
	public static function txtDay(){ return new Lemma(__FUNCTION__
		,'en',"Day"
		,'fr',"Jour"
		,'el',"Ημέρα"
		);}
	public static function txtDayOfWeek(){ return new Lemma(__FUNCTION__
		,'en',"Day of week"
		,'fr',"Jour de la semaine"
		,'el',"Ημέρα της εβδομάδας"
		);}
	public static function txtNight(){ return new Lemma(__FUNCTION__
		,'en',"Night"
		,'fr',"Nuit"
		,'el',"Νύχτα"
		);}
	public static function txtDays(){ return new Lemma(__FUNCTION__
		,'en',"Days"
		,'fr',"Jours"
		,'el',"Ημέρες"
		);}
	public static function txtXDays(){ return new Lemma(__FUNCTION__
		,'en',"%s days"
		,'fr',"%s jours"
		,'el',"%s ημέρες"
		);}
	public static function txtXDaysAgo(){ return new Lemma(__FUNCTION__
		,'en',"%s days ago"
		,'fr',"Il y a %s jours"
		,'el',"Πριν από %s ημέρες"
		);}
	public static function txtXTimeAgo(){ return new Lemma(__FUNCTION__
		,'en',"%s ago"
		,'fr',"Il y a %s"
		,'el',"Πριν από %s"
		);}
	public static function txtInXDays(){ return new Lemma(__FUNCTION__
		,'en',"In %s days"
		,'fr',"Dans %s jours"
		,'el',"Σε %s ημέρες"
		);}
	public static function txtInXTime(){ return new Lemma(__FUNCTION__
		,'en',"In %s"
		,'fr',"Dans %s"
		,'el',"Σε %s"
		);}
	public static function txtTimeZone(){ return new Lemma(__FUNCTION__
		,'en',"Time zone"
		,'fr',"Fuseau horaire"
		,'el',"Ζώνη ώρας"
		);}
	public static function txtJanuary(){ return new Lemma(__FUNCTION__
		,'en',"January"
		,'fr',"janvier"
		,'el',"Ιανουάριος"
		);}
	public static function txtFebruary(){ return new Lemma(__FUNCTION__
		,'en',"February"
		,'fr',"février"
		,'el',"Φεβρουάριος"
		);}
	public static function txtMarch(){ return new Lemma(__FUNCTION__
		,'en',"March"
		,'fr',"mars"
		,'el',"Μάρτιος"
		);}
	public static function txtApril(){ return new Lemma(__FUNCTION__
		,'en',"April"
		,'fr',"avril"
		,'el',"Απρίλιος"
		);}
	public static function txtMay(){ return new Lemma(__FUNCTION__
		,'en',"May"
		,'fr',"mai"
		,'el',"Μάιος"
		);}
	public static function txtJune(){ return new Lemma(__FUNCTION__
		,'en',"June"
		,'fr',"juin"
		,'el',"Ιούνιος"
		);}
	public static function txtJuly(){ return new Lemma(__FUNCTION__
		,'en',"July"
		,'fr',"juillet"
		,'el',"Ιούλιος"
		);}
	public static function txtAugust(){ return new Lemma(__FUNCTION__
		,'en',"August"
		,'fr',"août"
		,'el',"Αύγουστος"
		);}
	public static function txtSeptember(){ return new Lemma(__FUNCTION__
		,'en',"September"
		,'fr',"septembre"
		,'el',"Σεπτέμβριος"
		);}
	public static function txtOctober(){ return new Lemma(__FUNCTION__
		,'en',"October"
		,'fr',"octobre"
		,'el',"Οκτώβριος"
		);}
	public static function txtNovember(){ return new Lemma(__FUNCTION__
		,'en',"November"
		,'fr',"novembre"
		,'el',"Νοέμβριος"
		);}
	public static function txtDecember(){ return new Lemma(__FUNCTION__
		,'en',"December"
		,'fr',"décembre"
		,'el',"Δεκέμβριος"
		);}

	public static function txtJan_(){ return new Lemma(__FUNCTION__
		,'en',"Jan"
		,'fr',"jan."
		,'el',"Ιαν."
		);}
	public static function txtFeb_(){ return new Lemma(__FUNCTION__
		,'en',"Feb"
		,'fr',"fév."
		,'el',"Φεβ."
		);}
	public static function txtMar_(){ return new Lemma(__FUNCTION__
		,'en',"Mar"
		,'fr',"mars"
		,'el',"Μάρ."
		);}
	public static function txtApr_(){ return new Lemma(__FUNCTION__
		,'en',"Apr"
		,'fr',"avr."
		,'el',"Απρ."
		);}
	public static function txtMay_(){ return new Lemma(__FUNCTION__
		,'en',"May"
		,'fr',"mai"
		,'el',"Μάι."
		);}
	public static function txtJun_(){ return new Lemma(__FUNCTION__
		,'en',"Jun"
		,'fr',"juin"
		,'el',"Ιούν."
		);}
	public static function txtJul_(){ return new Lemma(__FUNCTION__
		,'en',"Jul"
		,'fr',"juil"
		,'el',"Ιούλ."
		);}
	public static function txtAug_(){ return new Lemma(__FUNCTION__
		,'en',"Aug"
		,'fr',"août"
		,'el',"Αύγ."
		);}
	public static function txtSep_(){ return new Lemma(__FUNCTION__
		,'en',"Sep"
		,'fr',"sep."
		,'el',"Σεπ."
		);}
	public static function txtOct_(){ return new Lemma(__FUNCTION__
		,'en',"Oct"
		,'fr',"oct."
		,'el',"Οκτ."
		);}
	public static function txtNov_(){ return new Lemma(__FUNCTION__
		,'en',"Nov"
		,'fr',"nov."
		,'el',"Νοέ."
		);}
	public static function txtDec_(){ return new Lemma(__FUNCTION__
		,'en',"Dec"
		,'fr',"déc."
		,'el',"Δεκ."
		);}

	public static function txtMonday(){ return new Lemma(__FUNCTION__
		,'en',"Monday"
		,'fr',"lundi"
		,'el',"Δευτέρα"
		);}
	public static function txtTuesday(){ return new Lemma(__FUNCTION__
		,'en',"Tuesday"
		,'fr',"mardi"
		,'el',"Τρίτη"
		);}
	public static function txtWednesday(){ return new Lemma(__FUNCTION__
		,'en',"Wednesday"
		,'fr',"mercredi"
		,'el',"Τετάρτη"
		);}
	public static function txtThursday(){ return new Lemma(__FUNCTION__
		,'en',"Thursday"
		,'fr',"jeudi"
		,'el',"Πέμπτη"
		);}
	public static function txtFriday(){ return new Lemma(__FUNCTION__
		,'en',"Friday"
		,'fr',"vendredi"
		,'el',"Παρασκευή"
		);}
	public static function txtSaturday(){ return new Lemma(__FUNCTION__
		,'en',"Saturday"
		,'fr',"samedi"
		,'el',"Σάββατο"
		);}
	public static function txtSunday(){ return new Lemma(__FUNCTION__
		,'en',"Sunday"
		,'fr',"dimanche"
		,'el',"Κυριακή"
		);}

	public static function txtMon_(){ return new Lemma(__FUNCTION__
		,'en',"Mon"
		,'fr',"lun."
		,'el',"Δευ."
		);}
	public static function txtTue_(){ return new Lemma(__FUNCTION__
		,'en',"Tue"
		,'fr',"mar."
		,'el',"Τρί."
		);}
	public static function txtWed_(){ return new Lemma(__FUNCTION__
		,'en',"Wed"
		,'fr',"mer."
		,'el',"Τετ."
		);}
	public static function txtThu_(){ return new Lemma(__FUNCTION__
		,'en',"Thu"
		,'fr',"jeu."
		,'el',"Πέμ."
		);}
	public static function txtFri_(){ return new Lemma(__FUNCTION__
		,'en',"Fri"
		,'fr',"ven."
		,'el',"Παρ."
		);}
	public static function txtSat_(){ return new Lemma(__FUNCTION__
		,'en',"Sat"
		,'fr',"sam."
		,'el',"Σάβ."
		);}
	public static function txtSun_(){ return new Lemma(__FUNCTION__
		,'en',"Sun"
		,'fr',"dim."
		,'el',"Κυρ."
		);}





	public static function txtSubmit(){ return new Lemma(__FUNCTION__
		,'en',"Submit"
		,'fr',"Soumettre"
		,'el',"Αποστολή"
		);}
	public static function txtLogin(){ return new Lemma(__FUNCTION__
		,'en',"Login"
		,'fr',"Connexion"
		,'el',"Login"
		);}
	public static function txtLogoff(){ return new Lemma(__FUNCTION__
		,'en',"Logoff"
		,'fr',"Déconnexion"
		,'el',"Logoff"
		);}
	public static function txtBack(){ return new Lemma(__FUNCTION__
		,'en',"Back"
		,'fr',"Retour"
		,'el',"Επιστροφή"
		);}
	public static function txtOK(){ return new Lemma(__FUNCTION__
		,'en',"OK"
		,'fr',"OK"
		,'el',"OK"
		);}
	public static function txtApply(){ return new Lemma(__FUNCTION__
		,'en',"Apply"
		,'fr',"Appliquer"
		,'el',"Εφαρμογή"
		);}
	public static function txtCancel(){ return new Lemma(__FUNCTION__
		,'en',"Cancel"
		,'fr',"Annuler"
		,'el',"Άκυρο"
		);}
	public static function txtSend(){ return new Lemma(__FUNCTION__
		,'en',"Send"
		,'fr',"Envoyer"
		,'el',"Αποστολή"
		);}
	public static function txtSave(){ return new Lemma(__FUNCTION__
		,'en',"Save"
		,'fr',"Sauvegarder"
		,'el',"Αποθήκευση"
		);}
	public static function txtDelete(){ return new Lemma(__FUNCTION__
		,'en',"Delete"
		,'fr',"Supprimer"
		,'el',"Διαγραφή"
		);}
	public static function txtRename(){ return new Lemma(__FUNCTION__
		,'en',"Rename"
		,'fr',"Renommer"
		,'el',"Μετονομασία"
		);}
	public static function txtPrint(){ return new Lemma(__FUNCTION__
		,'en',"Print"
		,'fr',"Imprimer"
		,'el',"Εκτύπωση"
		);}
	public static function txtClose(){ return new Lemma(__FUNCTION__
		,'en',"Close"
		,'fr',"Fermer"
		,'el',"Κλείσιμο"
		);}
	public static function txtAsk(){ return new Lemma(__FUNCTION__
		,'en',"Ask"
		,'fr',"Demander"
		,'el',"Ερώτηση"
		);}
	public static function txtUpdate(){ return new Lemma(__FUNCTION__
		,'en',"Update"
		,'fr',"Mettre à jour"
		,'el',"Ανανέωση"
		);}
	public static function txtSelect(){ return new Lemma(__FUNCTION__
		,'en',"Select"
		,'fr',"Sélectionner"
		,'el',"Επιλογή"
		);}
	public static function txtCompare(){ return new Lemma(__FUNCTION__
		,'en',"Compare"
		,'fr',"Comparer"
		,'el',"Σύγκριση"
		);}
	public static function txtSearch(){ return new Lemma(__FUNCTION__
		,'en',"Search"
		,'fr',"Rechercher"
		,'el',"Αναζήτηση"
		);}
	public static function txtYes(){ return new Lemma(__FUNCTION__
		,'en',"Yes"
		,'fr',"Oui"
		,'el',"Ναι"
		);}
	public static function txtNo(){ return new Lemma(__FUNCTION__
		,'en',"No"
		,'fr',"Non"
		,'el',"Όχι"
		);}
	public static function txtNext(){ return new Lemma(__FUNCTION__
		,'en',"Next"
		,'fr',"Suivant"
		,'el',"Επόμενο"
		);}
	public static function txtPrevious(){ return new Lemma(__FUNCTION__
		,'en',"Previous"
		,'fr',"Précédent"
		,'el',"Προηγούμενο"
		);}
	public static function txtModify(){ return new Lemma(__FUNCTION__
		,'en',"Modify"
		,'fr',"Modifier"
		,'el',"Επεξεργασία"
		);}
	public static function txtContinue(){ return new Lemma(__FUNCTION__
		,'en',"Continue"
		,'fr',"Continuer"
		,'el',"Συνέχεια"
		);}

	public static function txtHome(){ return new Lemma(__FUNCTION__
		,'en',"Home"
		,'fr',"Accueil"
		,'el',"Αρχική"
		);}
	public static function txtSettings(){ return new Lemma(__FUNCTION__
		,'en',"Settings"
		,'fr',"Paramètres"
		,'el',"Ρυθμίσεις"
		);}


	public static function txtUser(){ return new Lemma(__FUNCTION__
		,'en',"User"
		,'fr',"Utilisateur"
		,'el',"Χρήστης"
		);}
	public static function txtUsers(){ return new Lemma(__FUNCTION__
		,'en',"Users"
		,'fr',"Utilisateurs"
		,'el',"Χρήστες"
		);}
	public static function txtChangePassword(){ return new Lemma(__FUNCTION__
		,'en',"Change password"
		,'fr',"Mot de passe"
		,'el',"Αλλαγή κωδικού"
		);}
	public static function txtResetPassword(){ return new Lemma(__FUNCTION__
		,'en',"Reset password"
		,'fr',"Mot de passe"
		,'el',"Αλλαγή κωδικού"
		);}
	public static function txtResetPasswordLong(){ return new Lemma(__FUNCTION__
		,'en',"Reset password"
		,'fr',"Réinitialiser le mot de passe"
		,'el',"Αλλαγή κωδικού"
		);}
	public static function txtReset(){ return new Lemma(__FUNCTION__
		,'en',"Reset"
		,'fr',"Réinitialiser"
		,'el',"Αλλαγή"
		);}
	public static function txtChangeProfile(){ return new Lemma(__FUNCTION__
		,'en',"Change profile"
		,'fr',"Profil"
		,'el',"Αλλαγή προφίλ"
		);}
	public static function txtModifyProfile(){ return new Lemma(__FUNCTION__
		,'en',"Modify profile"
		,'fr',"Modifier profil"
		,'el',"Αλλαγή προφίλ"
		);}

	public static function txtError(){ return new Lemma(__FUNCTION__
		,'en',"Error"
		,'fr',"Erreur"
		,'el',"Σφάλμα"
		);}

	public static function txtActionLogin(){ return new Lemma(__FUNCTION__
		,'en',"Login"
		,'fr',"Connexion"
		,'el',"Login"
		);}
	public static function txtActionLogoff(){ return new Lemma(__FUNCTION__
		,'en',"Logoff"
		,'fr',"Déconnexion"
		,'el',"Logoff"
		);}
	public static function txtActionChangePassword(){ return new Lemma(__FUNCTION__
		,'en',"Change password"
		,'fr',"Mot de passe"
		,'el',"Αλλαγή κωδικού"
		);}
	public static function txtActionChangeProfile(){ return new Lemma(__FUNCTION__
		,'en',"Change profile"
		,'fr',"Profil d'utilisateur"
		,'el',"Προφίλ χρήστη"
		);}
	public static function txtActionCreateUser(){ return new Lemma(__FUNCTION__
		,'en',"Create user"
		,'fr',"Création d'un utilisateur"
		,'el',"Δημιουργία χρήστη"
		);}
	public static function txtActionForgottenPassword(){ return new Lemma(__FUNCTION__
		,'en',"Forgotten your password?"
		,'fr',"Mot de passe oublié ?"
		,'el',"Υπενθύμιση κωδικού"
		);}

	public static function txtMsgCannotDisplayWebPage(){ return new Lemma(__FUNCTION__
		,'en',"Cannot display the web page."
		,'fr',"La page ne peut pas être affichée."
		);}
	public static function txtMsgUnderConstruction(){ return new Lemma(__FUNCTION__
		,'en',"Under construction."
		,'fr',"En construction."
		,'el',"Υπό κατασκευή."
		);}
	public static function txtMsgNotImplemented(){ return new Lemma(__FUNCTION__
		,'en',"Not implemented."
		,'fr',"Non implémenté."
		,'el',"Μη υλοποιημένο."
		);}
	public static function txtMsgPageNotFound(){ return new Lemma(__FUNCTION__
		,'en',"Page not found."
		,'fr',"La page n'était pas trouvée."
		,'el',"Η σελίδα δεν βρέθηκε."
		);}
	public static function txtMsgObjectNotFound(){ return new Lemma(__FUNCTION__
		,'en',"Object not found."
		,'fr',"L'objet n'était pas trouvé."
		,'el',"Το αντικείμενο δεν βρέθηκε."
		);}
	public static function txtMsgAccessDenied(){ return new Lemma(__FUNCTION__
		,'en',"Access denied."
		,'fr',"Accès refusé."
		,'el',"Μη επιτρεπτή πρόσβαση."
		);}
	public static function txtMsgInvalidUsername(){ return new Lemma(__FUNCTION__
		,'en',"Unknown user."
		,'fr',"Utilisateur inconnu."
		,'el',"Λάθος όνομα χρήστη."
		);}
	public static function txtMsgInvalidPassword(){ return new Lemma(__FUNCTION__
		,'en',"Invalid password."
		,'fr',"Mot de passe incorrect."
		,'el',"Λάθος κωδικός πρόσβασης."
		);}
	public static function txtMsgInvalidUsernameOrPassword(){ return new Lemma(__FUNCTION__
		,'en',"Invalid username or password."
		,'fr',"Utilisateur inconnu ou mot de passe incorrect."
		,'el',"Λάθος όνομα χρήστη ή λάθος κωδικός πρόσβασης."
		);}
	public static function txtMsgMultipleUsersFound(){ return new Lemma(__FUNCTION__
		,'en',"Multiple users found."
		,'fr',"Plusieurs utilisateurs trouvés."
		,'el',"Βρέθηκαν πολλαπλοί χρήστες."
		);}
	public static function txtMsgEmailSentSuccessfully(){ return new Lemma(__FUNCTION__
		,'en',"The e-mail has been sent successfully."
		,'fr',"Le message e-mail a été bien envoyé."
		,'el',"Η αποστολή του e-mail έγινε επιτυχώς."
		);}
	public static function txtMsgInvalidEmail(){ return new Lemma(__FUNCTION__
		,'en',"Invalid e-mail address."
		,'fr',"L'adresse e-mail n'est pas valide."
		,'el',"Λάθος διεύθυνση e-mail."
		);}
	public static function txtMsgInvalidPhone(){ return new Lemma(__FUNCTION__
		,'en',"Invalid phone number. Please use international format (+123456789)."
		,'fr',"Le numéro n'est pas valide. Veuillez utilisez le format international (+123456789)."
		,'el',"Λάθος αριθμός τηλεφώνου. Χρησιμοποιήστε το διεθνές πρότυπο (+123456789)."
		);}
	public static function txtMsgInvalidURL(){ return new Lemma(__FUNCTION__
		,'en',"Invalid address."
		,'fr',"L'adresse n'est pas valide."
		,'el',"Λάθος διεύθυνση."
		);}
	public static function txtMsgInvalidValue(){ return new Lemma(__FUNCTION__
		,'en',"Invalid value."
		,'fr',"Le valeur n'est pas valide."
		,'el',"Λάθος τιμή."
		);}

	public static function txtMsgAccountBanned(){ return new Lemma(__FUNCTION__
		,'en',"User account locked."
		,'fr',"Compte utilisateur bloqué."
		,'el',"Kλειδωμένος λογαριασμός χρήστη."
		);}

	public static function txtMsgPasswordsDoNotMatch(){ return new Lemma(__FUNCTION__
		,'en',"The passwords do not match."
		,'fr',"Les deux mots de passe ne sont pas identiques."
		,'el',"Οι κωδικοί δεν είναι ίδιοι."
		);}

	public static function txtMsgMandatoryFields(){ return new Lemma(__FUNCTION__
		,'en',"The fields with * are mandatory."
		,'fr',"Les champs avec * sont obligatoires."
		,'el',"Τα πεδία με * είναι υποχρεωτικά."
		);}

	public static function txtMsgMandatoryField(){ return new Lemma(__FUNCTION__
		,'en',"This field is mandatory."
		,'fr',"Ce champ est obligatoire."
		,'el',"Το πεδίο αυτό είναι υποχρεωτικό."
		);}

	public static function txtMsgFieldMandatoryInAllLanguages(){ return new Lemma(__FUNCTION__
		,'en',"This field is mandatory in all languages."
		,'fr',"Ce champ est obligatoire en toutes les langues."
		,'el',"Το πεδίο αυτό είναι υποχρεωτικό σε όλες τις γλώσσες."
		);}

	public static function txtMsgPasswordChanged(){ return new Lemma(__FUNCTION__
		,'en',"The password has been changed."
		,'fr',"Le mot de passe a été changé."
		,'el',"Ο κωδικός πρόσβασης άλλαξε."
		);}

	public static function txtMsgProfileChanged(){ return new Lemma(__FUNCTION__
		,'en',"The user profile has been changed."
		,'fr',"Le profil de l'utilisateur a été changé."
		,'el',"Το προφίλ χρήστη άλλαξε."
		);}

	public static function txtMsgUsernameExists(){ return new Lemma(__FUNCTION__
		,'en',"This username already exists."
		,'fr',"Cet utilisateur existe déjà."
		,'el',"Αυτό το όνομα χρήστη υπάρχει ήδη."
		);}

	public static function txtMsgCannotSendEmail(){ return new Lemma(__FUNCTION__
		,'en',"Error while sending e-mail."
		,'fr',"Erreur lors de l'envoi d'e-mail."
		,'el',"Σφάλμα κατά την αποστολή e-mail."
		);}

	public static function txtMsgCannotConnectToDatabase(){ return new Lemma(__FUNCTION__
		,'en',"Error while connecting to the database."
		,'fr',"Erreur lors de la connexion à la base de données."
		,'el',"Σφάλμα κατά την σύνδεση με τη βάση δεδομένων."
		);}
	public static function txtMsgCannotCreateDatabase(){ return new Lemma(__FUNCTION__
		,'en',"Error while creating database schema."
		,'fr',"Erreur lors de la création de la base de données."
		,'el',"Σφάλμα κατά την δημιουργία νέας βάσης δεδομένων."
		);}

	public static function txtMsgCannotDeleteCurrentUser(){ return new Lemma(__FUNCTION__
		,'en',"Cannot delete current user."
		,'fr',"Il est impossible de supprimer l'utilisateur courant."
		,'el',"Δεν είναι δυνατό να διαγραφεί ο τρέχον χρήστης."
		);}

	public static function txtMsgObjectXNotFound(){ return new Lemma(__FUNCTION__
		,'en',"This object was not found: %s."
		,'fr',"Objet non trouvé : %s."
		,'el',"Το αντικείμενο αυτό δεν βρέθηκε: [%s]."
		);}
	public static function txtMsgObjectXAlreadyExists(){ return new Lemma(__FUNCTION__
		,'en',"This object already exists: %s."
		,'fr',"Cet objet existe déjà : %s."
		,'el',"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		);}
	public static function txtMsgCannotDeleteSystemObject(){ return new Lemma(__FUNCTION__
		,'en',"This object is used by the system."
		,'fr',"Cet objet est utilisé par le système."
		,'el',"Το αντικείμενο είναι απαραίτητο για την ομαλή λειτουργεία του συστήματος."
		);}


	public static function txtMsgXItemNotFound(){ return new Lemma(__FUNCTION__
		,'en',"This object was not found [%s %s]."
		,'fr',"Objet non trouvé [%s %s]."
		,'el',"Το αντικείμενο αυτό δεν βρέθηκε: [%s %s]."
		);}
	public static function txtMsgXItemAlreadyExists(){ return new Lemma(__FUNCTION__
		,'fr',"Cet objet existe déjà: %s."
		,'en',"This object already exists: %s."
		,'el',"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		);}

	public static function txtMsgCancelling(){ return new Lemma(__FUNCTION__
		,'en',"Cancelling..."
		,'fr',"Annulation..."
		,'el',"Ακύρωση..."
		);}
	public static function txtMsgProgressCancelled(){ return new Lemma(__FUNCTION__
		,'en',"The process has been cancelled."
		,'fr',"Le processus a été annulé."
		,'el',"Η διαδικασία ακυρώθηκε."
		);}
	public static function txtMsgProgressCompleted(){ return new Lemma(__FUNCTION__
		,'en',"The process is completed."
		,'fr',"Le processus est terminé."
		,'el',"Η διαδικασία ολοκληρώθηκε."
		);}
	public static function txtMsgNoObjectFound(){ return new Lemma(__FUNCTION__
		,'en',"No object found."
		,'fr',"Pas d'objet trouvé."
		,'el',"Δε βρέθηκε κανένα αντικείμενο."
		);}
	public static function txtMsgInvalidAction(){ return new Lemma(__FUNCTION__
		,'en',"Invalid action."
		,'fr',"Action invalide."
		,'el',"Εσφαλμένη εντολή."
		);}

	public static function txtMsgCannotConnectToLdapServer(){ return new Lemma(__FUNCTION__
		,'en',"Cannot connect to the database."
		,'fr',"Erreur à la connexion à la base de données."
		,'el',"Σφάλμα σύνδεσης με την βάση δεδομένων."
		);}


	public static function txtMsgDevelopmentEnvironment(){ return new Lemma(__FUNCTION__
		,'en',"You are viewing this message because the application runs in DEVELOPMENT mode."
		,'fr',"Ce message s'affiche parce que l'application est en mode DEVELOPPEMENT."
		,'el',"Το μήνυμα αυτό εμφανίζεται γιατί η εφαρμογή τρέχει σε περιβάλλον ανάπτυξης."
		);}
	public static function txtMsgAnErrorOccurred(){ return new Lemma(__FUNCTION__
		,'en',"An unexpected server error has occurred."
		,'fr',"Il y avait une erreur inattendue."
		,'el',"Προέκυψε ένα σφάλμα στον διακομιστή."
		);}
	public static function txtMsgAnErrorOccurredAndTeamNotified(){ return new Lemma(__FUNCTION__
		,'en',"An unexpected server error has occurred. The support team has been notified."
		,'fr',"Il y avait une erreur inattendue. L'équipe de support vient d'en être notifié."
		,'el',"Προέκυψε ένα σφάλμα στον διακομιστή. Η ομάδα υποστήριξης ειδοποιήθηκε."
		);}


	public static function txtMsgErrorWhileUploadingFile(){ return new Lemma(__FUNCTION__
		,'en',"An error occurred while uploading file."
		,'fr',"Erreur pendant l'envoi du fichier."
		,'el',"Σφάλμα κατά την αποστολή του αρχείου."
		);}

	public static function txtMsgErrorWhileDownloadingFile(){ return new Lemma(__FUNCTION__
		,'en',"An error occurred while downloading file."
		,'fr',"Erreur pendant le téléchargement du fichier."
		,'el',"Σφάλμα κατά την λήψη του αρχείου."
		);}
	public static function txtMsgUnsavedChanges(){ return new Lemma(__FUNCTION__
		,'en',"There are unsaved changes."
		,'fr',"Il y a de changements qui ne sont pas sauvegardés."
		,'el',"Υπάρχουν μη αποθηκευμένες αλλαγές."
		);}



	public static function txtUnit_byte(){ return new Lemma(__FUNCTION__
		,'en',"B"
		,'fr',"o"
		,'el',"B"
		);}
	public static function txtUnit_sec(){ return new Lemma(__FUNCTION__
		,'en',"sec"
		,'fr',"sec"
		,'el',"sec"
		);}
	public static function txtUnit_day(){ return new Lemma(__FUNCTION__
		,'en',"d"
		,'fr',"j"
		,'el',"ημ"
		);}
	public static function txtUnit_hour(){ return new Lemma(__FUNCTION__
		,'en',"h"
		,'fr',"h"
		,'el',"ώρ"
		);}


	public static function txtLang_($x){ return static::_forward($x); }
	public static function txtLang_en(){ return new Lemma(__FUNCTION__
		,'en',"English"
		,'fr',"Anglais"
		,'el',"Αγγλικά"
		);}
	public static function txtLang_fr(){ return new Lemma(__FUNCTION__
		,'en',"French"
		,'fr',"Français"
		,'el',"Γαλλικά"
		);}
	public static function txtLang_el(){ return new Lemma(__FUNCTION__
		,'en',"Greek"
		,'fr',"Grec"
		,'el',"Ελληνικά"
		);}
	public static function txtLang_ar(){ return new Lemma(__FUNCTION__
		,'en',"Arabic"
		,'fr',"Arabic"
		);}
	public static function txtLang_de(){ return new Lemma(__FUNCTION__
		,'en',"German"
		,'fr',"Allemand"
		);}
	public static function txtLang_es(){ return new Lemma(__FUNCTION__
		,'en',"Spanish"
		,'fr',"Espagnol"
		);}
	public static function txtLang_it(){ return new Lemma(__FUNCTION__
		,'en',"Italian"
		,'fr',"Italien"
		);}
	public static function txtLang_fi(){ return new Lemma(__FUNCTION__
		,'en',"Finnish"
		,'fr',"Finnois"
		);}
	public static function txtLang_ja(){ return new Lemma(__FUNCTION__
		,'en',"Japanese"
		,'fr',"Japonais"
		);}
	public static function txtLang_ko(){ return new Lemma(__FUNCTION__
		,'en',"Korean"
		,'fr',"Coréen"
		);}
	public static function txtLang_nl(){ return new Lemma(__FUNCTION__
		,'en',"Dutch"
		,'fr',"Néerlandais"
		);}
	public static function txtLang_no(){ return new Lemma(__FUNCTION__
		,'en',"Norwegian"
		,'fr',"Norvégien"
		);}
	public static function txtLang_pl(){ return new Lemma(__FUNCTION__
		,'en',"Polish"
		,'fr',"Polonais"
		);}
	public static function txtLang_pt(){ return new Lemma(__FUNCTION__
		,'en',"Portuguese"
		,'fr',"Portugais"
		);}
	public static function txtLang_ru(){ return new Lemma(__FUNCTION__
		,'en',"Russian"
		,'fr',"Russe"
		);}
	public static function txtLang_sv(){ return new Lemma(__FUNCTION__
		,'en',"Swedish"
		,'fr',"Suédois"
		);}
	public static function txtLang_zh(){ return new Lemma(__FUNCTION__
		,'en',"Chinese"
		,'fr',"Chinois"
		);}

	public static function txtLang_ab(){ return new Lemma(__FUNCTION__
		,'en',"Abkhaz"
		);}
	public static function txtLang_aa(){ return new Lemma(__FUNCTION__
		,'en',"Afar"
		);}
	public static function txtLang_af(){ return new Lemma(__FUNCTION__
		,'en',"Afrikaans"
		);}
	public static function txtLang_ak(){ return new Lemma(__FUNCTION__
		,'en',"Akan"
		);}
	public static function txtLang_sq(){ return new Lemma(__FUNCTION__
		,'en',"Albanian"
		);}
	public static function txtLang_am(){ return new Lemma(__FUNCTION__
		,'en',"Amharic"
		);}
	public static function txtLang_an(){ return new Lemma(__FUNCTION__
		,'en',"Aragonese"
		);}
	public static function txtLang_hy(){ return new Lemma(__FUNCTION__
		,'en',"Armenian"
		);}
	public static function txtLang_as(){ return new Lemma(__FUNCTION__
		,'en',"Assamese"
		);}
	public static function txtLang_av(){ return new Lemma(__FUNCTION__
		,'en',"Avaric"
		);}
	public static function txtLang_ae(){ return new Lemma(__FUNCTION__
		,'en',"Avestan"
		);}
	public static function txtLang_ay(){ return new Lemma(__FUNCTION__
		,'en',"Aymara"
		);}
	public static function txtLang_az(){ return new Lemma(__FUNCTION__
		,'en',"Azerbaijani"
		);}
	public static function txtLang_bm(){ return new Lemma(__FUNCTION__
		,'en',"Bambara"
		);}
	public static function txtLang_ba(){ return new Lemma(__FUNCTION__
		,'en',"Bashkir"
		);}
	public static function txtLang_eu(){ return new Lemma(__FUNCTION__
		,'en',"Basque"
		);}
	public static function txtLang_be(){ return new Lemma(__FUNCTION__
		,'en',"Belarusian"
		);}
	public static function txtLang_bn(){ return new Lemma(__FUNCTION__
		,'en',"Bengali"
		);}
	public static function txtLang_bh(){ return new Lemma(__FUNCTION__
		,'en',"Bihari"
		);}
	public static function txtLang_bi(){ return new Lemma(__FUNCTION__
		,'en',"Bislama"
		);}
	public static function txtLang_bs(){ return new Lemma(__FUNCTION__
		,'en',"Bosnian"
		);}
	public static function txtLang_br(){ return new Lemma(__FUNCTION__
		,'en',"Breton"
		);}
	public static function txtLang_bg(){ return new Lemma(__FUNCTION__
		,'en',"Bulgarian"
		);}
	public static function txtLang_my(){ return new Lemma(__FUNCTION__
		,'en',"Burmese"
		);}
	public static function txtLang_ca(){ return new Lemma(__FUNCTION__
		,'en',"Catalan"
		);}
	public static function txtLang_ch(){ return new Lemma(__FUNCTION__
		,'en',"Chamorro"
		);}
	public static function txtLang_ce(){ return new Lemma(__FUNCTION__
		,'en',"Chechen"
		);}
	public static function txtLang_ny(){ return new Lemma(__FUNCTION__
		,'en',"Chichewa"
		);}
	public static function txtLang_cv(){ return new Lemma(__FUNCTION__
		,'en',"Chuvash"
		);}
	public static function txtLang_kw(){ return new Lemma(__FUNCTION__
		,'en',"Cornish"
		);}
	public static function txtLang_co(){ return new Lemma(__FUNCTION__
		,'en',"Corsican"
		);}
	public static function txtLang_cr(){ return new Lemma(__FUNCTION__
		,'en',"Cree"
		);}
	public static function txtLang_hr(){ return new Lemma(__FUNCTION__
		,'en',"Croatian"
		);}
	public static function txtLang_cs(){ return new Lemma(__FUNCTION__
		,'en',"Czech"
		);}
	public static function txtLang_da(){ return new Lemma(__FUNCTION__
		,'en',"Danish"
		);}
	public static function txtLang_dv(){ return new Lemma(__FUNCTION__
		,'en',"Divehi"
		);}
	public static function txtLang_dz(){ return new Lemma(__FUNCTION__
		,'en',"Dzongkha"
		);}
	public static function txtLang_eo(){ return new Lemma(__FUNCTION__
		,'en',"Esperanto"
		);}
	public static function txtLang_et(){ return new Lemma(__FUNCTION__
		,'en',"Estonian"
		);}
	public static function txtLang_ee(){ return new Lemma(__FUNCTION__
		,'en',"Ewe"
		);}
	public static function txtLang_fo(){ return new Lemma(__FUNCTION__
		,'en',"Faroese"
		);}
	public static function txtLang_fj(){ return new Lemma(__FUNCTION__
		,'en',"Fijian"
		);}
	public static function txtLang_ff(){ return new Lemma(__FUNCTION__
		,'en',"Fula"
		);}
	public static function txtLang_gl(){ return new Lemma(__FUNCTION__
		,'en',"Galician"
		);}
	public static function txtLang_ka(){ return new Lemma(__FUNCTION__
		,'en',"Georgian"
		);}
	public static function txtLang_gn(){ return new Lemma(__FUNCTION__
		,'en',"Guaraní"
		);}
	public static function txtLang_gu(){ return new Lemma(__FUNCTION__
		,'en',"Gujarati"
		);}
	public static function txtLang_ht(){ return new Lemma(__FUNCTION__
		,'en',"Haitian"
		);}
	public static function txtLang_ha(){ return new Lemma(__FUNCTION__
		,'en',"Hausa"
		);}
	public static function txtLang_he(){ return new Lemma(__FUNCTION__
		,'en',"Hebrew"
		);}
	public static function txtLang_hz(){ return new Lemma(__FUNCTION__
		,'en',"Herero"
		);}
	public static function txtLang_hi(){ return new Lemma(__FUNCTION__
		,'en',"Hindi"
		);}
	public static function txtLang_ho(){ return new Lemma(__FUNCTION__
		,'en',"Hiri Motu"
		);}
	public static function txtLang_hu(){ return new Lemma(__FUNCTION__
		,'en',"Hungarian"
		);}
	public static function txtLang_ia(){ return new Lemma(__FUNCTION__
		,'en',"Interlingua"
		);}
	public static function txtLang_id(){ return new Lemma(__FUNCTION__
		,'en',"Indonesian"
		);}
	public static function txtLang_ie(){ return new Lemma(__FUNCTION__
		,'en',"Interlingue"
		);}
	public static function txtLang_ga(){ return new Lemma(__FUNCTION__
		,'en',"Irish"
		);}
	public static function txtLang_ig(){ return new Lemma(__FUNCTION__
		,'en',"Igbo"
		);}
	public static function txtLang_ik(){ return new Lemma(__FUNCTION__
		,'en',"Inupiaq"
		);}
	public static function txtLang_io(){ return new Lemma(__FUNCTION__
		,'en',"Ido"
		);}
	public static function txtLang_is(){ return new Lemma(__FUNCTION__
		,'en',"Icelandic"
		);}
	public static function txtLang_iu(){ return new Lemma(__FUNCTION__
		,'en',"Inuktitut"
		);}
	public static function txtLang_jv(){ return new Lemma(__FUNCTION__
		,'en',"Javanese"
		);}
	public static function txtLang_kl(){ return new Lemma(__FUNCTION__
		,'en',"Kalaallisut"
		);}
	public static function txtLang_kn(){ return new Lemma(__FUNCTION__
		,'en',"Kannada"
		);}
	public static function txtLang_kr(){ return new Lemma(__FUNCTION__
		,'en',"Kanuri"
		);}
	public static function txtLang_ks(){ return new Lemma(__FUNCTION__
		,'en',"Kashmiri"
		);}
	public static function txtLang_kk(){ return new Lemma(__FUNCTION__
		,'en',"Kazakh"
		);}
	public static function txtLang_km(){ return new Lemma(__FUNCTION__
		,'en',"Khmer"
		);}
	public static function txtLang_ki(){ return new Lemma(__FUNCTION__
		,'en',"Kikuyu"
		);}
	public static function txtLang_rw(){ return new Lemma(__FUNCTION__
		,'en',"Kinyarwanda"
		);}
	public static function txtLang_ky(){ return new Lemma(__FUNCTION__
		,'en',"Kyrgyz"
		);}
	public static function txtLang_kv(){ return new Lemma(__FUNCTION__
		,'en',"Komi"
		);}
	public static function txtLang_kg(){ return new Lemma(__FUNCTION__
		,'en',"Kongo"
		);}
	public static function txtLang_ku(){ return new Lemma(__FUNCTION__
		,'en',"Kurdish"
		);}
	public static function txtLang_kj(){ return new Lemma(__FUNCTION__
		,'en',"Kwanyama"
		);}
	public static function txtLang_la(){ return new Lemma(__FUNCTION__
		,'en',"Latin"
		);}
	public static function txtLang_lb(){ return new Lemma(__FUNCTION__
		,'en',"Luxembourgish"
		);}
	public static function txtLang_lg(){ return new Lemma(__FUNCTION__
		,'en',"Ganda"
		);}
	public static function txtLang_li(){ return new Lemma(__FUNCTION__
		,'en',"Limburgish"
		);}
	public static function txtLang_ln(){ return new Lemma(__FUNCTION__
		,'en',"Lingala"
		);}
	public static function txtLang_lo(){ return new Lemma(__FUNCTION__
		,'en',"Lao"
		);}
	public static function txtLang_lt(){ return new Lemma(__FUNCTION__
		,'en',"Lithuanian"
		);}
	public static function txtLang_lu(){ return new Lemma(__FUNCTION__
		,'en',"Luba-Katanga"
		);}
	public static function txtLang_lv(){ return new Lemma(__FUNCTION__
		,'en',"Latvian"
		);}
	public static function txtLang_gv(){ return new Lemma(__FUNCTION__
		,'en',"Manx"
		);}
	public static function txtLang_mk(){ return new Lemma(__FUNCTION__
		,'en',"Macedonian"
		);}
	public static function txtLang_mg(){ return new Lemma(__FUNCTION__
		,'en',"Malagasy"
		);}
	public static function txtLang_ms(){ return new Lemma(__FUNCTION__
		,'en',"Malay"
		);}
	public static function txtLang_ml(){ return new Lemma(__FUNCTION__
		,'en',"Malayalam"
		);}
	public static function txtLang_mt(){ return new Lemma(__FUNCTION__
		,'en',"Maltese"
		);}
	public static function txtLang_mi(){ return new Lemma(__FUNCTION__
		,'en',"Māori"
		);}
	public static function txtLang_mr(){ return new Lemma(__FUNCTION__
		,'en',"Marathi"
		);}
	public static function txtLang_mh(){ return new Lemma(__FUNCTION__
		,'en',"Marshallese"
		);}
	public static function txtLang_mn(){ return new Lemma(__FUNCTION__
		,'en',"Mongolian"
		);}
	public static function txtLang_na(){ return new Lemma(__FUNCTION__
		,'en',"Nauru"
		);}
	public static function txtLang_nv(){ return new Lemma(__FUNCTION__
		,'en',"Navajo"
		);}
	public static function txtLang_nb(){ return new Lemma(__FUNCTION__
		,'en',"Norwegian Bokmål"
		);}
	public static function txtLang_nd(){ return new Lemma(__FUNCTION__
		,'en',"North Ndebele"
		);}
	public static function txtLang_ne(){ return new Lemma(__FUNCTION__
		,'en',"Nepali"
		);}
	public static function txtLang_ng(){ return new Lemma(__FUNCTION__
		,'en',"Ndonga"
		);}
	public static function txtLang_nn(){ return new Lemma(__FUNCTION__
		,'en',"Norwegian Nynorsk"
		);}
	public static function txtLang_ii(){ return new Lemma(__FUNCTION__
		,'en',"Nuosu"
		);}
	public static function txtLang_nr(){ return new Lemma(__FUNCTION__
		,'en',"South Ndebele"
		);}
	public static function txtLang_oc(){ return new Lemma(__FUNCTION__
		,'en',"Occitan"
		);}
	public static function txtLang_oj(){ return new Lemma(__FUNCTION__
		,'en',"Ojibwe"
		);}
	public static function txtLang_cu(){ return new Lemma(__FUNCTION__
		,'en',"Old Slavonic"
		);}
	public static function txtLang_om(){ return new Lemma(__FUNCTION__
		,'en',"Oromo"
		);}
	public static function txtLang_or(){ return new Lemma(__FUNCTION__
		,'en',"Oriya"
		);}
	public static function txtLang_os(){ return new Lemma(__FUNCTION__
		,'en',"Ossetian"
		);}
	public static function txtLang_pa(){ return new Lemma(__FUNCTION__
		,'en',"Panjabi"
		);}
	public static function txtLang_pi(){ return new Lemma(__FUNCTION__
		,'en',"Pāli"
		);}
	public static function txtLang_fa(){ return new Lemma(__FUNCTION__
		,'en',"Farsi"
		);}
	public static function txtLang_ps(){ return new Lemma(__FUNCTION__
		,'en',"Pashto"
		);}
	public static function txtLang_qu(){ return new Lemma(__FUNCTION__
		,'en',"Quechua"
		);}
	public static function txtLang_rm(){ return new Lemma(__FUNCTION__
		,'en',"Romansh"
		);}
	public static function txtLang_rn(){ return new Lemma(__FUNCTION__
		,'en',"Kirundi"
		);}
	public static function txtLang_ro(){ return new Lemma(__FUNCTION__
		,'en',"Romanian"
		);}
	public static function txtLang_sa(){ return new Lemma(__FUNCTION__
		,'en',"Sanskrit"
		);}
	public static function txtLang_sc(){ return new Lemma(__FUNCTION__
		,'en',"Sardinian"
		);}
	public static function txtLang_sd(){ return new Lemma(__FUNCTION__
		,'en',"Sindhi"
		);}
	public static function txtLang_se(){ return new Lemma(__FUNCTION__
		,'en',"Northern Sami"
		);}
	public static function txtLang_sm(){ return new Lemma(__FUNCTION__
		,'en',"Samoan"
		);}
	public static function txtLang_sg(){ return new Lemma(__FUNCTION__
		,'en',"Sango"
		);}
	public static function txtLang_sr(){ return new Lemma(__FUNCTION__
		,'en',"Serbian"
		);}
	public static function txtLang_gd(){ return new Lemma(__FUNCTION__
		,'en',"Scottish Gaelic"
		);}
	public static function txtLang_sn(){ return new Lemma(__FUNCTION__
		,'en',"Shona"
		);}
	public static function txtLang_si(){ return new Lemma(__FUNCTION__
		,'en',"Sinhala"
		);}
	public static function txtLang_sk(){ return new Lemma(__FUNCTION__
		,'en',"Slovak"
		);}
	public static function txtLang_sl(){ return new Lemma(__FUNCTION__
		,'en',"Slovene"
		);}
	public static function txtLang_so(){ return new Lemma(__FUNCTION__
		,'en',"Somali"
		);}
	public static function txtLang_st(){ return new Lemma(__FUNCTION__
		,'en',"Southern Sotho"
		);}
	public static function txtLang_su(){ return new Lemma(__FUNCTION__
		,'en',"Sundanese"
		);}
	public static function txtLang_sw(){ return new Lemma(__FUNCTION__
		,'en',"Swahili"
		);}
	public static function txtLang_ss(){ return new Lemma(__FUNCTION__
		,'en',"Swati"
		);}
	public static function txtLang_ta(){ return new Lemma(__FUNCTION__
		,'en',"Tamil"
		);}
	public static function txtLang_te(){ return new Lemma(__FUNCTION__
		,'en',"Telugu"
		);}
	public static function txtLang_tg(){ return new Lemma(__FUNCTION__
		,'en',"Tajik"
		);}
	public static function txtLang_th(){ return new Lemma(__FUNCTION__
		,'en',"Thai"
		);}
	public static function txtLang_ti(){ return new Lemma(__FUNCTION__
		,'en',"Tigrinya"
		);}
	public static function txtLang_bo(){ return new Lemma(__FUNCTION__
		,'en',"Tibetan"
		);}
	public static function txtLang_tk(){ return new Lemma(__FUNCTION__
		,'en',"Turkmen"
		);}
	public static function txtLang_tl(){ return new Lemma(__FUNCTION__
		,'en',"Tagalog"
		);}
	public static function txtLang_tn(){ return new Lemma(__FUNCTION__
		,'en',"Tswana"
		);}
	public static function txtLang_to(){ return new Lemma(__FUNCTION__
		,'en',"Tonga"
		);}
	public static function txtLang_tr(){ return new Lemma(__FUNCTION__
		,'en',"Turkish"
		);}
	public static function txtLang_ts(){ return new Lemma(__FUNCTION__
		,'en',"Tsonga"
		);}
	public static function txtLang_tt(){ return new Lemma(__FUNCTION__
		,'en',"Tatar"
		);}
	public static function txtLang_tw(){ return new Lemma(__FUNCTION__
		,'en',"Twi"
		);}
	public static function txtLang_ty(){ return new Lemma(__FUNCTION__
		,'en',"Tahitian"
		);}
	public static function txtLang_ug(){ return new Lemma(__FUNCTION__
		,'en',"Uyghur"
		);}
	public static function txtLang_uk(){ return new Lemma(__FUNCTION__
		,'en',"Ukrainian"
		);}
	public static function txtLang_ur(){ return new Lemma(__FUNCTION__
		,'en',"Urdu"
		);}
	public static function txtLang_uz(){ return new Lemma(__FUNCTION__
		,'en',"Uzbek"
		);}
	public static function txtLang_ve(){ return new Lemma(__FUNCTION__
		,'en',"Venda"
		);}
	public static function txtLang_vi(){ return new Lemma(__FUNCTION__
		,'en',"Vietnamese"
		);}
	public static function txtLang_vo(){ return new Lemma(__FUNCTION__
		,'en',"Volapük"
		);}
	public static function txtLang_wa(){ return new Lemma(__FUNCTION__
		,'en',"Walloon"
		);}
	public static function txtLang_cy(){ return new Lemma(__FUNCTION__
		,'en',"Welsh"
		);}
	public static function txtLang_wo(){ return new Lemma(__FUNCTION__
		,'en',"Wolof"
		);}
	public static function txtLang_fy(){ return new Lemma(__FUNCTION__
		,'en',"Western Frisian"
		);}
	public static function txtLang_xh(){ return new Lemma(__FUNCTION__
		,'en',"Xhosa"
		);}
	public static function txtLang_yi(){ return new Lemma(__FUNCTION__
		,'en',"Yiddish"
		);}
	public static function txtLang_yo(){ return new Lemma(__FUNCTION__
		,'en',"Yoruba"
		);}
	public static function txtLang_za(){ return new Lemma(__FUNCTION__
		,'en',"Zhuang"
		);}
	public static function txtLang_zu(){ return new Lemma(__FUNCTION__
		,'en',"Zulu"
		);}



	public static function txtCountry_($x) { return static::__($x); }
	public static function txtCountry_AD(){ return new Lemma(__FUNCTION__
		,'en',"ANDORRA"
		,'fr',"ANDORRE"
		);}
	public static function txtCountry_AE(){ return new Lemma(__FUNCTION__
		,'en',"UNITED ARAB EMIRATES"
		,'fr',"ÉMIRATS ARABES UNIS"
		);}
	public static function txtCountry_AF(){ return new Lemma(__FUNCTION__
		,'en',"AFGHANISTAN"
		,'fr',"AFGHANISTAN"
		);}
	public static function txtCountry_AG(){ return new Lemma(__FUNCTION__
		,'en',"ANTIGUA AND BARBUDA"
		,'fr',"ANTIGUA-ET-BARBUDA"
		);}
	public static function txtCountry_AI(){ return new Lemma(__FUNCTION__
		,'en',"ANGUILLA"
		,'fr',"ANGUILLA"
		);}
	public static function txtCountry_AL(){ return new Lemma(__FUNCTION__
		,'en',"ALBANIA"
		,'fr',"ALBANIE"
		);}
	public static function txtCountry_AM(){ return new Lemma(__FUNCTION__
		,'en',"ARMENIA"
		,'fr',"ARMÉNIE"
		);}
	public static function txtCountry_AO(){ return new Lemma(__FUNCTION__
		,'en',"ANGOLA"
		,'fr',"ANGOLA"
		);}
	public static function txtCountry_AQ(){ return new Lemma(__FUNCTION__
		,'en',"ANTARCTICA"
		,'fr',"ANTARCTIQUE"
		);}
	public static function txtCountry_AR(){ return new Lemma(__FUNCTION__
		,'en',"ARGENTINA"
		,'fr',"ARGENTINE"
		);}
	public static function txtCountry_AS(){ return new Lemma(__FUNCTION__
		,'en',"AMERICAN SAMOA"
		,'fr',"SAMOA AMÉRICAINES"
		);}
	public static function txtCountry_AT(){ return new Lemma(__FUNCTION__
		,'en',"AUSTRIA"
		,'fr',"AUTRICHE"
		);}
	public static function txtCountry_AU(){ return new Lemma(__FUNCTION__
		,'en',"AUSTRALIA"
		,'fr',"AUSTRALIE"
		);}
	public static function txtCountry_AW(){ return new Lemma(__FUNCTION__
		,'en',"ARUBA"
		,'fr',"ARUBA"
		);}
	public static function txtCountry_AX(){ return new Lemma(__FUNCTION__
		,'en',"ÅLAND ISLANDS"
		,'fr',"ÅLAND, ÎLES"
		);}
	public static function txtCountry_AZ(){ return new Lemma(__FUNCTION__
		,'en',"AZERBAIJAN"
		,'fr',"AZERBAÏDJAN"
		);}
	public static function txtCountry_BA(){ return new Lemma(__FUNCTION__
		,'en',"BOSNIA AND HERZEGOVINA"
		,'fr',"BOSNIE-HERZÉGOVINE"
		);}
	public static function txtCountry_BB(){ return new Lemma(__FUNCTION__
		,'en',"BARBADOS"
		,'fr',"BARBADE"
		);}
	public static function txtCountry_BD(){ return new Lemma(__FUNCTION__
		,'en',"BANGLADESH"
		,'fr',"BANGLADESH"
		);}
	public static function txtCountry_BE(){ return new Lemma(__FUNCTION__
		,'en',"BELGIUM"
		,'fr',"BELGIQUE"
		);}
	public static function txtCountry_BF(){ return new Lemma(__FUNCTION__
		,'en',"BURKINA FASO"
		,'fr',"BURKINA FASO"
		);}
	public static function txtCountry_BG(){ return new Lemma(__FUNCTION__
		,'en',"BULGARIA"
		,'fr',"BULGARIE"
		);}
	public static function txtCountry_BH(){ return new Lemma(__FUNCTION__
		,'en',"BAHRAIN"
		,'fr',"BAHREÏN"
		);}
	public static function txtCountry_BI(){ return new Lemma(__FUNCTION__
		,'en',"BURUNDI"
		,'fr',"BURUNDI"
		);}
	public static function txtCountry_BJ(){ return new Lemma(__FUNCTION__
		,'en',"BENIN"
		,'fr',"BÉNIN"
		);}
	public static function txtCountry_BL(){ return new Lemma(__FUNCTION__
		,'en',"SAINT BARTHÉLEMY"
		,'fr',"SAINT-BARTHÉLEMY"
		);}
	public static function txtCountry_BM(){ return new Lemma(__FUNCTION__
		,'en',"BERMUDA"
		,'fr',"BERMUDES"
		);}
	public static function txtCountry_BN(){ return new Lemma(__FUNCTION__
		,'en',"BRUNEI DARUSSALAM"
		,'fr',"BRUNÉI DARUSSALAM"
		);}
	public static function txtCountry_BO(){ return new Lemma(__FUNCTION__
		,'en',"BOLIVIA, PLURINATIONAL STATE OF"
		,'fr',"BOLIVIE, L'ÉTAT PLURINATIONAL DE"
		);}
	public static function txtCountry_BQ(){ return new Lemma(__FUNCTION__
		,'en',"BONAIRE, SAINT EUSTATIUS AND SABA"
		,'fr',"BONAIRE, SAINT-EUSTACHE ET SABA"
		);}
	public static function txtCountry_BR(){ return new Lemma(__FUNCTION__
		,'en',"BRAZIL"
		,'fr',"BRÉSIL"
		);}
	public static function txtCountry_BS(){ return new Lemma(__FUNCTION__
		,'en',"BAHAMAS"
		,'fr',"BAHAMAS"
		);}
	public static function txtCountry_BT(){ return new Lemma(__FUNCTION__
		,'en',"BHUTAN"
		,'fr',"BHOUTAN"
		);}
	public static function txtCountry_BV(){ return new Lemma(__FUNCTION__
		,'en',"BOUVET ISLAND"
		,'fr',"BOUVET, ÎLE"
		);}
	public static function txtCountry_BW(){ return new Lemma(__FUNCTION__
		,'en',"BOTSWANA"
		,'fr',"BOTSWANA"
		);}
	public static function txtCountry_BY(){ return new Lemma(__FUNCTION__
		,'en',"BELARUS"
		,'fr',"BÉLARUS"
		);}
	public static function txtCountry_BZ(){ return new Lemma(__FUNCTION__
		,'en',"BELIZE"
		,'fr',"BELIZE"
		);}
	public static function txtCountry_CA(){ return new Lemma(__FUNCTION__
		,'en',"CANADA"
		,'fr',"CANADA"
		);}
	public static function txtCountry_CC(){ return new Lemma(__FUNCTION__
		,'en',"COCOS (KEELING) ISLANDS"
		,'fr',"COCOS (KEELING), ÎLES"
		);}
	public static function txtCountry_CD(){ return new Lemma(__FUNCTION__
		,'en',"CONGO, THE DEMOCRATIC REPUBLIC OF THE"
		,'fr',"CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU"
		);}
	public static function txtCountry_CF(){ return new Lemma(__FUNCTION__
		,'en',"CENTRAL AFRICAN REPUBLIC"
		,'fr',"CENTRAFRICAINE, RÉPUBLIQUE"
		);}
	public static function txtCountry_CG(){ return new Lemma(__FUNCTION__
		,'en',"CONGO"
		,'fr',"CONGO"
		);}
	public static function txtCountry_CH(){ return new Lemma(__FUNCTION__
		,'en',"SWITZERLAND"
		,'fr',"SUISSE"
		);}
	public static function txtCountry_CI(){ return new Lemma(__FUNCTION__
		,'en',"CÔTE D'IVOIRE"
		,'fr',"CÔTE D'IVOIRE"
		);}
	public static function txtCountry_CK(){ return new Lemma(__FUNCTION__
		,'en',"COOK ISLANDS"
		,'fr',"COOK, ÎLES"
		);}
	public static function txtCountry_CL(){ return new Lemma(__FUNCTION__
		,'en',"CHILE"
		,'fr',"CHILI"
		);}
	public static function txtCountry_CM(){ return new Lemma(__FUNCTION__
		,'en',"CAMEROON"
		,'fr',"CAMEROUN"
		);}
	public static function txtCountry_CN(){ return new Lemma(__FUNCTION__
		,'en',"CHINA"
		,'fr',"CHINE"
		);}
	public static function txtCountry_CO(){ return new Lemma(__FUNCTION__
		,'en',"COLOMBIA"
		,'fr',"COLOMBIE"
		);}
	public static function txtCountry_CR(){ return new Lemma(__FUNCTION__
		,'en',"COSTA RICA"
		,'fr',"COSTA RICA"
		);}
	public static function txtCountry_CU(){ return new Lemma(__FUNCTION__
		,'en',"CUBA"
		,'fr',"CUBA"
		);}
	public static function txtCountry_CV(){ return new Lemma(__FUNCTION__
		,'en',"CAPE VERDE"
		,'fr',"CAP-VERT"
		);}
	public static function txtCountry_CW(){ return new Lemma(__FUNCTION__
		,'en',"CURAÇAO"
		,'fr',"CURAÇAO"
		);}
	public static function txtCountry_CX(){ return new Lemma(__FUNCTION__
		,'en',"CHRISTMAS ISLAND"
		,'fr',"CHRISTMAS, ÎLE"
		);}
	public static function txtCountry_CY(){ return new Lemma(__FUNCTION__
		,'en',"CYPRUS"
		,'fr',"CHYPRE"
		);}
	public static function txtCountry_CZ(){ return new Lemma(__FUNCTION__
		,'en',"CZECH REPUBLIC"
		,'fr',"TCHÈQUE, RÉPUBLIQUE"
		);}
	public static function txtCountry_DE(){ return new Lemma(__FUNCTION__
		,'en',"GERMANY"
		,'fr',"ALLEMAGNE"
		);}
	public static function txtCountry_DJ(){ return new Lemma(__FUNCTION__
		,'en',"DJIBOUTI"
		,'fr',"DJIBOUTI"
		);}
	public static function txtCountry_DK(){ return new Lemma(__FUNCTION__
		,'en',"DENMARK"
		,'fr',"DANEMARK"
		);}
	public static function txtCountry_DM(){ return new Lemma(__FUNCTION__
		,'en',"DOMINICA"
		,'fr',"DOMINIQUE"
		);}
	public static function txtCountry_DO(){ return new Lemma(__FUNCTION__
		,'en',"DOMINICAN REPUBLIC"
		,'fr',"DOMINICAINE, RÉPUBLIQUE"
		);}
	public static function txtCountry_DZ(){ return new Lemma(__FUNCTION__
		,'en',"ALGERIA"
		,'fr',"ALGÉRIE"
		);}
	public static function txtCountry_EC(){ return new Lemma(__FUNCTION__
		,'en',"ECUADOR"
		,'fr',"ÉQUATEUR"
		);}
	public static function txtCountry_EE(){ return new Lemma(__FUNCTION__
		,'en',"ESTONIA"
		,'fr',"ESTONIE"
		);}
	public static function txtCountry_EG(){ return new Lemma(__FUNCTION__
		,'en',"EGYPT"
		,'fr',"ÉGYPTE"
		);}
	public static function txtCountry_EH(){ return new Lemma(__FUNCTION__
		,'en',"WESTERN SAHARA"
		,'fr',"SAHARA OCCIDENTAL"
		);}
	public static function txtCountry_ER(){ return new Lemma(__FUNCTION__
		,'en',"ERITREA"
		,'fr',"ÉRYTHRÉE"
		);}
	public static function txtCountry_ES(){ return new Lemma(__FUNCTION__
		,'en',"SPAIN"
		,'fr',"ESPAGNE"
		);}
	public static function txtCountry_ET(){ return new Lemma(__FUNCTION__
		,'en',"ETHIOPIA"
		,'fr',"ÉTHIOPIE"
		);}
	public static function txtCountry_FI(){ return new Lemma(__FUNCTION__
		,'en',"FINLAND"
		,'fr',"FINLANDE"
		);}
	public static function txtCountry_FJ(){ return new Lemma(__FUNCTION__
		,'en',"FIJI"
		,'fr',"FIDJI"
		);}
	public static function txtCountry_FK(){ return new Lemma(__FUNCTION__
		,'en',"FALKLAND ISLANDS (MALVINAS)"
		,'fr',"FALKLAND, ÎLES (MALVINAS)"
		);}
	public static function txtCountry_FM(){ return new Lemma(__FUNCTION__
		,'en',"MICRONESIA, FEDERATED STATES OF"
		,'fr',"MICRONÉSIE, ÉTATS FÉDÉRÉS DE"
		);}
	public static function txtCountry_FO(){ return new Lemma(__FUNCTION__
		,'en',"FAROE ISLANDS"
		,'fr',"FÉROÉ, ÎLES"
		);}
	public static function txtCountry_FR(){ return new Lemma(__FUNCTION__
		,'en',"FRANCE"
		,'fr',"FRANCE"
		);}
	public static function txtCountry_GA(){ return new Lemma(__FUNCTION__
		,'en',"GABON"
		,'fr',"GABON"
		);}
	public static function txtCountry_GB(){ return new Lemma(__FUNCTION__
		,'en',"UNITED KINGDOM"
		,'fr',"ROYAUME-UNI"
		);}
	public static function txtCountry_GD(){ return new Lemma(__FUNCTION__
		,'en',"GRENADA"
		,'fr',"GRENADE"
		);}
	public static function txtCountry_GE(){ return new Lemma(__FUNCTION__
		,'en',"GEORGIA"
		,'fr',"GÉORGIE"
		);}
	public static function txtCountry_GF(){ return new Lemma(__FUNCTION__
		,'en',"FRENCH GUIANA"
		,'fr',"GUYANE FRANÇAISE"
		);}
	public static function txtCountry_GG(){ return new Lemma(__FUNCTION__
		,'en',"GUERNSEY"
		,'fr',"GUERNESEY"
		);}
	public static function txtCountry_GH(){ return new Lemma(__FUNCTION__
		,'en',"GHANA"
		,'fr',"GHANA"
		);}
	public static function txtCountry_GI(){ return new Lemma(__FUNCTION__
		,'en',"GIBRALTAR"
		,'fr',"GIBRALTAR"
		);}
	public static function txtCountry_GL(){ return new Lemma(__FUNCTION__
		,'en',"GREENLAND"
		,'fr',"GROENLAND"
		);}
	public static function txtCountry_GM(){ return new Lemma(__FUNCTION__
		,'en',"GAMBIA"
		,'fr',"GAMBIE"
		);}
	public static function txtCountry_GN(){ return new Lemma(__FUNCTION__
		,'en',"GUINEA"
		,'fr',"GUINÉE"
		);}
	public static function txtCountry_GP(){ return new Lemma(__FUNCTION__
		,'en',"GUADELOUPE"
		,'fr',"GUADELOUPE"
		);}
	public static function txtCountry_GQ(){ return new Lemma(__FUNCTION__
		,'en',"EQUATORIAL GUINEA"
		,'fr',"GUINÉE ÉQUATORIALE"
		);}
	public static function txtCountry_GR(){ return new Lemma(__FUNCTION__
		,'en',"GREECE"
		,'fr',"GRÈCE"
		);}
	public static function txtCountry_GS(){ return new Lemma(__FUNCTION__
		,'en',"SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS"
		,'fr',"GÉORGIE DU SUD ET LES ÎLES SANDWICH DU SUD"
		);}
	public static function txtCountry_GT(){ return new Lemma(__FUNCTION__
		,'en',"GUATEMALA"
		,'fr',"GUATEMALA"
		);}
	public static function txtCountry_GU(){ return new Lemma(__FUNCTION__
		,'en',"GUAM"
		,'fr',"GUAM"
		);}
	public static function txtCountry_GW(){ return new Lemma(__FUNCTION__
		,'en',"GUINEA-BISSAU"
		,'fr',"GUINÉE-BISSAU"
		);}
	public static function txtCountry_GY(){ return new Lemma(__FUNCTION__
		,'en',"GUYANA"
		,'fr',"GUYANA"
		);}
	public static function txtCountry_HK(){ return new Lemma(__FUNCTION__
		,'en',"HONG KONG"
		,'fr',"HONG-KONG"
		);}
	public static function txtCountry_HM(){ return new Lemma(__FUNCTION__
		,'en',"HEARD ISLAND AND MCDONALD ISLANDS"
		,'fr',"HEARD, ÎLE ET MCDONALD, ÎLES"
		);}
	public static function txtCountry_HN(){ return new Lemma(__FUNCTION__
		,'en',"HONDURAS"
		,'fr',"HONDURAS"
		);}
	public static function txtCountry_HR(){ return new Lemma(__FUNCTION__
		,'en',"CROATIA"
		,'fr',"CROATIE"
		);}
	public static function txtCountry_HT(){ return new Lemma(__FUNCTION__
		,'en',"HAITI"
		,'fr',"HAÏTI"
		);}
	public static function txtCountry_HU(){ return new Lemma(__FUNCTION__
		,'en',"HUNGARY"
		,'fr',"HONGRIE"
		);}
	public static function txtCountry_ID(){ return new Lemma(__FUNCTION__
		,'en',"INDONESIA"
		,'fr',"INDONÉSIE"
		);}
	public static function txtCountry_IE(){ return new Lemma(__FUNCTION__
		,'en',"IRELAND"
		,'fr',"IRLANDE"
		);}
	public static function txtCountry_IL(){ return new Lemma(__FUNCTION__
		,'en',"ISRAEL"
		,'fr',"ISRAËL"
		);}
	public static function txtCountry_IM(){ return new Lemma(__FUNCTION__
		,'en',"ISLE OF MAN"
		,'fr',"ÎLE DE MAN"
		);}
	public static function txtCountry_IN(){ return new Lemma(__FUNCTION__
		,'en',"INDIA"
		,'fr',"INDE"
		);}
	public static function txtCountry_IO(){ return new Lemma(__FUNCTION__
		,'en',"BRITISH INDIAN OCEAN TERRITORY"
		,'fr',"OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L"
		);}
	public static function txtCountry_IQ(){ return new Lemma(__FUNCTION__
		,'en',"IRAQ"
		,'fr',"IRAQ"
		);}
	public static function txtCountry_IR(){ return new Lemma(__FUNCTION__
		,'en',"IRAN, ISLAMIC REPUBLIC OF"
		,'fr',"IRAN, RÉPUBLIQUE ISLAMIQUE D"
		);}
	public static function txtCountry_IS(){ return new Lemma(__FUNCTION__
		,'en',"ICELAND"
		,'fr',"ISLANDE"
		);}
	public static function txtCountry_IT(){ return new Lemma(__FUNCTION__
		,'en',"ITALY"
		,'fr',"ITALIE"
		);}
	public static function txtCountry_JE(){ return new Lemma(__FUNCTION__
		,'en',"JERSEY"
		,'fr',"JERSEY"
		);}
	public static function txtCountry_JM(){ return new Lemma(__FUNCTION__
		,'en',"JAMAICA"
		,'fr',"JAMAÏQUE"
		);}
	public static function txtCountry_JO(){ return new Lemma(__FUNCTION__
		,'en',"JORDAN"
		,'fr',"JORDANIE"
		);}
	public static function txtCountry_JP(){ return new Lemma(__FUNCTION__
		,'en',"JAPAN"
		,'fr',"JAPON"
		);}
	public static function txtCountry_KE(){ return new Lemma(__FUNCTION__
		,'en',"KENYA"
		,'fr',"KENYA"
		);}
	public static function txtCountry_KG(){ return new Lemma(__FUNCTION__
		,'en',"KYRGYZSTAN"
		,'fr',"KIRGHIZISTAN"
		);}
	public static function txtCountry_KH(){ return new Lemma(__FUNCTION__
		,'en',"CAMBODIA"
		,'fr',"CAMBODGE"
		);}
	public static function txtCountry_KI(){ return new Lemma(__FUNCTION__
		,'en',"KIRIBATI"
		,'fr',"KIRIBATI"
		);}
	public static function txtCountry_KM(){ return new Lemma(__FUNCTION__
		,'en',"COMOROS"
		,'fr',"COMORES"
		);}
	public static function txtCountry_KN(){ return new Lemma(__FUNCTION__
		,'en',"SAINT KITTS AND NEVIS"
		,'fr',"SAINT-KITTS-ET-NEVIS"
		);}
	public static function txtCountry_KP(){ return new Lemma(__FUNCTION__
		,'en',"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF"
		,'fr',"CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE"
		);}
	public static function txtCountry_KR(){ return new Lemma(__FUNCTION__
		,'en',"KOREA, REPUBLIC OF"
		,'fr',"CORÉE, RÉPUBLIQUE DE"
		);}
	public static function txtCountry_KW(){ return new Lemma(__FUNCTION__
		,'en',"KUWAIT"
		,'fr',"KOWEÏT"
		);}
	public static function txtCountry_KY(){ return new Lemma(__FUNCTION__
		,'en',"CAYMAN ISLANDS"
		,'fr',"CAÏMANES, ÎLES"
		);}
	public static function txtCountry_KZ(){ return new Lemma(__FUNCTION__
		,'en',"KAZAKHSTAN"
		,'fr',"KAZAKHSTAN"
		);}
	public static function txtCountry_LA(){ return new Lemma(__FUNCTION__
		,'en',"LAO PEOPLE'S DEMOCRATIC REPUBLIC"
		,'fr',"LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE"
		);}
	public static function txtCountry_LB(){ return new Lemma(__FUNCTION__
		,'en',"LEBANON"
		,'fr',"LIBAN"
		);}
	public static function txtCountry_LC(){ return new Lemma(__FUNCTION__
		,'en',"SAINT LUCIA"
		,'fr',"SAINTE-LUCIE"
		);}
	public static function txtCountry_LI(){ return new Lemma(__FUNCTION__
		,'en',"LIECHTENSTEIN"
		,'fr',"LIECHTENSTEIN"
		);}
	public static function txtCountry_LK(){ return new Lemma(__FUNCTION__
		,'en',"SRI LANKA"
		,'fr',"SRI LANKA"
		);}
	public static function txtCountry_LR(){ return new Lemma(__FUNCTION__
		,'en',"LIBERIA"
		,'fr',"LIBÉRIA"
		);}
	public static function txtCountry_LS(){ return new Lemma(__FUNCTION__
		,'en',"LESOTHO"
		,'fr',"LESOTHO"
		);}
	public static function txtCountry_LT(){ return new Lemma(__FUNCTION__
		,'en',"LITHUANIA"
		,'fr',"LITUANIE"
		);}
	public static function txtCountry_LU(){ return new Lemma(__FUNCTION__
		,'en',"LUXEMBOURG"
		,'fr',"LUXEMBOURG"
		);}
	public static function txtCountry_LV(){ return new Lemma(__FUNCTION__
		,'en',"LATVIA"
		,'fr',"LETTONIE"
		);}
	public static function txtCountry_LY(){ return new Lemma(__FUNCTION__
		,'en',"LIBYAN ARAB JAMAHIRIYA"
		,'fr',"LIBYENNE, JAMAHIRIYA ARABE"
		);}
	public static function txtCountry_MA(){ return new Lemma(__FUNCTION__
		,'en',"MOROCCO"
		,'fr',"MAROC"
		);}
	public static function txtCountry_MC(){ return new Lemma(__FUNCTION__
		,'en',"MONACO"
		,'fr',"MONACO"
		);}
	public static function txtCountry_MD(){ return new Lemma(__FUNCTION__
		,'en',"MOLDOVA, REPUBLIC OF"
		,'fr',"MOLDOVA, RÉPUBLIQUE DE"
		);}
	public static function txtCountry_ME(){ return new Lemma(__FUNCTION__
		,'en',"MONTENEGRO"
		,'fr',"MONTÉNÉGRO"
		);}
	public static function txtCountry_MF(){ return new Lemma(__FUNCTION__
		,'en',"SAINT MARTIN (FRENCH PART)"
		,'fr',"SAINT-MARTIN(PARTIE FRANÇAISE)"
		);}
	public static function txtCountry_MG(){ return new Lemma(__FUNCTION__
		,'en',"MADAGASCAR"
		,'fr',"MADAGASCAR"
		);}
	public static function txtCountry_MH(){ return new Lemma(__FUNCTION__
		,'en',"MARSHALL ISLANDS"
		,'fr',"MARSHALL, ÎLES"
		);}
	public static function txtCountry_MK(){ return new Lemma(__FUNCTION__
		,'en',"MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF"
		,'fr',"MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE"
		);}
	public static function txtCountry_ML(){ return new Lemma(__FUNCTION__
		,'en',"MALI"
		,'fr',"MALI"
		);}
	public static function txtCountry_MM(){ return new Lemma(__FUNCTION__
		,'en',"MYANMAR"
		,'fr',"MYANMAR"
		);}
	public static function txtCountry_MN(){ return new Lemma(__FUNCTION__
		,'en',"MONGOLIA"
		,'fr',"MONGOLIE"
		);}
	public static function txtCountry_MO(){ return new Lemma(__FUNCTION__
		,'en',"MACAO"
		,'fr',"MACAO"
		);}
	public static function txtCountry_MP(){ return new Lemma(__FUNCTION__
		,'en',"NORTHERN MARIANA ISLANDS"
		,'fr',"MARIANNES DU NORD, ÎLES"
		);}
	public static function txtCountry_MQ(){ return new Lemma(__FUNCTION__
		,'en',"MARTINIQUE"
		,'fr',"MARTINIQUE"
		);}
	public static function txtCountry_MR(){ return new Lemma(__FUNCTION__
		,'en',"MAURITANIA"
		,'fr',"MAURITANIE"
		);}
	public static function txtCountry_MS(){ return new Lemma(__FUNCTION__
		,'en',"MONTSERRAT"
		,'fr',"MONTSERRAT"
		);}
	public static function txtCountry_MT(){ return new Lemma(__FUNCTION__
		,'en',"MALTA"
		,'fr',"MALTE"
		);}
	public static function txtCountry_MU(){ return new Lemma(__FUNCTION__
		,'en',"MAURITIUS"
		,'fr',"MAURICE"
		);}
	public static function txtCountry_MV(){ return new Lemma(__FUNCTION__
		,'en',"MALDIVES"
		,'fr',"MALDIVES"
		);}
	public static function txtCountry_MW(){ return new Lemma(__FUNCTION__
		,'en',"MALAWI"
		,'fr',"MALAWI"
		);}
	public static function txtCountry_MX(){ return new Lemma(__FUNCTION__
		,'en',"MEXICO"
		,'fr',"MEXIQUE"
		);}
	public static function txtCountry_MY(){ return new Lemma(__FUNCTION__
		,'en',"MALAYSIA"
		,'fr',"MALAISIE"
		);}
	public static function txtCountry_MZ(){ return new Lemma(__FUNCTION__
		,'en',"MOZAMBIQUE"
		,'fr',"MOZAMBIQUE"
		);}
	public static function txtCountry_NA(){ return new Lemma(__FUNCTION__
		,'en',"NAMIBIA"
		,'fr',"NAMIBIE"
		);}
	public static function txtCountry_NC(){ return new Lemma(__FUNCTION__
		,'en',"NEW CALEDONIA"
		,'fr',"NOUVELLE-CALÉDONIE"
		);}
	public static function txtCountry_NE(){ return new Lemma(__FUNCTION__
		,'en',"NIGER"
		,'fr',"NIGER"
		);}
	public static function txtCountry_NF(){ return new Lemma(__FUNCTION__
		,'en',"NORFOLK ISLAND"
		,'fr',"NORFOLK, ÎLE"
		);}
	public static function txtCountry_NG(){ return new Lemma(__FUNCTION__
		,'en',"NIGERIA"
		,'fr',"NIGÉRIA"
		);}
	public static function txtCountry_NI(){ return new Lemma(__FUNCTION__
		,'en',"NICARAGUA"
		,'fr',"NICARAGUA"
		);}
	public static function txtCountry_NL(){ return new Lemma(__FUNCTION__
		,'en',"NETHERLANDS"
		,'fr',"PAYS-BAS"
		);}
	public static function txtCountry_NO(){ return new Lemma(__FUNCTION__
		,'en',"NORWAY"
		,'fr',"NORVÈGE"
		);}
	public static function txtCountry_NP(){ return new Lemma(__FUNCTION__
		,'en',"NEPAL"
		,'fr',"NÉPAL"
		);}
	public static function txtCountry_NR(){ return new Lemma(__FUNCTION__
		,'en',"NAURU"
		,'fr',"NAURU"
		);}
	public static function txtCountry_NU(){ return new Lemma(__FUNCTION__
		,'en',"NIUE"
		,'fr',"NIUÉ"
		);}
	public static function txtCountry_NZ(){ return new Lemma(__FUNCTION__
		,'en',"NEW ZEALAND"
		,'fr',"NOUVELLE-ZÉLANDE"
		);}
	public static function txtCountry_OM(){ return new Lemma(__FUNCTION__
		,'en',"OMAN"
		,'fr',"OMAN"
		);}
	public static function txtCountry_PA(){ return new Lemma(__FUNCTION__
		,'en',"PANAMA"
		,'fr',"PANAMA"
		);}
	public static function txtCountry_PE(){ return new Lemma(__FUNCTION__
		,'en',"PERU"
		,'fr',"PÉROU"
		);}
	public static function txtCountry_PF(){ return new Lemma(__FUNCTION__
		,'en',"FRENCH POLYNESIA"
		,'fr',"POLYNÉSIE FRANÇAISE"
		);}
	public static function txtCountry_PG(){ return new Lemma(__FUNCTION__
		,'en',"PAPUA NEW GUINEA"
		,'fr',"PAPOUASIE-NOUVELLE-GUINÉE"
		);}
	public static function txtCountry_PH(){ return new Lemma(__FUNCTION__
		,'en',"PHILIPPINES"
		,'fr',"PHILIPPINES"
		);}
	public static function txtCountry_PK(){ return new Lemma(__FUNCTION__
		,'en',"PAKISTAN"
		,'fr',"PAKISTAN"
		);}
	public static function txtCountry_PL(){ return new Lemma(__FUNCTION__
		,'en',"POLAND"
		,'fr',"POLOGNE"
		);}
	public static function txtCountry_PM(){ return new Lemma(__FUNCTION__
		,'en',"SAINT PIERRE AND MIQUELON"
		,'fr',"SAINT-PIERRE-ET-MIQUELON"
		);}
	public static function txtCountry_PN(){ return new Lemma(__FUNCTION__
		,'en',"PITCAIRN"
		,'fr',"PITCAIRN"
		);}
	public static function txtCountry_PR(){ return new Lemma(__FUNCTION__
		,'en',"PUERTO RICO"
		,'fr',"PORTO RICO"
		);}
	public static function txtCountry_PS(){ return new Lemma(__FUNCTION__
		,'en',"PALESTINIAN TERRITORY, OCCUPIED"
		,'fr',"PALESTINIEN OCCUPÉ, TERRITOIRE"
		);}
	public static function txtCountry_PT(){ return new Lemma(__FUNCTION__
		,'en',"PORTUGAL"
		,'fr',"PORTUGAL"
		);}
	public static function txtCountry_PW(){ return new Lemma(__FUNCTION__
		,'en',"PALAU"
		,'fr',"PALAOS"
		);}
	public static function txtCountry_PY(){ return new Lemma(__FUNCTION__
		,'en',"PARAGUAY"
		,'fr',"PARAGUAY"
		);}
	public static function txtCountry_QA(){ return new Lemma(__FUNCTION__
		,'en',"QATAR"
		,'fr',"QATAR"
		);}
	public static function txtCountry_RE(){ return new Lemma(__FUNCTION__
		,'en',"RÉUNION"
		,'fr',"RÉUNION"
		);}
	public static function txtCountry_RO(){ return new Lemma(__FUNCTION__
		,'en',"ROMANIA"
		,'fr',"ROUMANIE"
		);}
	public static function txtCountry_RS(){ return new Lemma(__FUNCTION__
		,'en',"SERBIA"
		,'fr',"SERBIE"
		);}
	public static function txtCountry_RU(){ return new Lemma(__FUNCTION__
		,'en',"RUSSIAN FEDERATION"
		,'fr',"RUSSIE, FÉDÉRATION DE"
		);}
	public static function txtCountry_RW(){ return new Lemma(__FUNCTION__
		,'en',"RWANDA"
		,'fr',"RWANDA"
		);}
	public static function txtCountry_SA(){ return new Lemma(__FUNCTION__
		,'en',"SAUDI ARABIA"
		,'fr',"ARABIE SAOUDITE"
		);}
	public static function txtCountry_SB(){ return new Lemma(__FUNCTION__
		,'en',"SOLOMON ISLANDS"
		,'fr',"SALOMON, ÎLES"
		);}
	public static function txtCountry_SC(){ return new Lemma(__FUNCTION__
		,'en',"SEYCHELLES"
		,'fr',"SEYCHELLES"
		);}
	public static function txtCountry_SD(){ return new Lemma(__FUNCTION__
		,'en',"SUDAN"
		,'fr',"SOUDAN"
		);}
	public static function txtCountry_SE(){ return new Lemma(__FUNCTION__
		,'en',"SWEDEN"
		,'fr',"SUÈDE"
		);}
	public static function txtCountry_SG(){ return new Lemma(__FUNCTION__
		,'en',"SINGAPORE"
		,'fr',"SINGAPOUR"
		);}
	public static function txtCountry_SH(){ return new Lemma(__FUNCTION__
		,'en',"SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA"
		,'fr',"SAINTE-HÉLÈNE, ASCENSION ET TRISTAN DA CUNHA"
		);}
	public static function txtCountry_SI(){ return new Lemma(__FUNCTION__
		,'en',"SLOVENIA"
		,'fr',"SLOVÉNIE"
		);}
	public static function txtCountry_SJ(){ return new Lemma(__FUNCTION__
		,'en',"SVALBARD AND JAN MAYEN"
		,'fr',"SVALBARD ET ÎLE JAN MAYEN"
		);}
	public static function txtCountry_SK(){ return new Lemma(__FUNCTION__
		,'en',"SLOVAKIA"
		,'fr',"SLOVAQUIE"
		);}
	public static function txtCountry_SL(){ return new Lemma(__FUNCTION__
		,'en',"SIERRA LEONE"
		,'fr',"SIERRA LEONE"
		);}
	public static function txtCountry_SM(){ return new Lemma(__FUNCTION__
		,'en',"SAN MARINO"
		,'fr',"SAINT-MARIN"
		);}
	public static function txtCountry_SN(){ return new Lemma(__FUNCTION__
		,'en',"SENEGAL"
		,'fr',"SÉNÉGAL"
		);}
	public static function txtCountry_SO(){ return new Lemma(__FUNCTION__
		,'en',"SOMALIA"
		,'fr',"SOMALIE"
		);}
	public static function txtCountry_SR(){ return new Lemma(__FUNCTION__
		,'en',"SURINAME"
		,'fr',"SURINAME"
		);}
	public static function txtCountry_ST(){ return new Lemma(__FUNCTION__
		,'en',"SAO TOME AND PRINCIPE"
		,'fr',"SAO TOMÉ-ET-PRINCIPE"
		);}
	public static function txtCountry_SV(){ return new Lemma(__FUNCTION__
		,'en',"EL SALVADOR"
		,'fr',"EL SALVADOR"
		);}
	public static function txtCountry_SX(){ return new Lemma(__FUNCTION__
		,'en',"SINT MAARTEN (DUTCH PART)"
		,'fr',"SAINT-MARTIN (PARTIE NÉERLANDAISE)"
		);}
	public static function txtCountry_SY(){ return new Lemma(__FUNCTION__
		,'en',"SYRIAN ARAB REPUBLIC"
		,'fr',"SYRIENNE, RÉPUBLIQUE ARABE"
		);}
	public static function txtCountry_SZ(){ return new Lemma(__FUNCTION__
		,'en',"SWAZILAND"
		,'fr',"SWAZILAND"
		);}
	public static function txtCountry_TC(){ return new Lemma(__FUNCTION__
		,'en',"TURKS AND CAICOS ISLANDS"
		,'fr',"TURKS ET CAÏQUES, ÎLES"
		);}
	public static function txtCountry_TD(){ return new Lemma(__FUNCTION__
		,'en',"CHAD"
		,'fr',"TCHAD"
		);}
	public static function txtCountry_TF(){ return new Lemma(__FUNCTION__
		,'en',"FRENCH SOUTHERN TERRITORIES"
		,'fr',"TERRES AUSTRALES FRANÇAISES"
		);}
	public static function txtCountry_TG(){ return new Lemma(__FUNCTION__
		,'en',"TOGO"
		,'fr',"TOGO"
		);}
	public static function txtCountry_TH(){ return new Lemma(__FUNCTION__
		,'en',"THAILAND"
		,'fr',"THAÏLANDE"
		);}
	public static function txtCountry_TJ(){ return new Lemma(__FUNCTION__
		,'en',"TAJIKISTAN"
		,'fr',"TADJIKISTAN"
		);}
	public static function txtCountry_TK(){ return new Lemma(__FUNCTION__
		,'en',"TOKELAU"
		,'fr',"TOKELAU"
		);}
	public static function txtCountry_TL(){ return new Lemma(__FUNCTION__
		,'en',"TIMOR-LESTE"
		,'fr',"TIMOR-LESTE"
		);}
	public static function txtCountry_TM(){ return new Lemma(__FUNCTION__
		,'en',"TURKMENISTAN"
		,'fr',"TURKMÉNISTAN"
		);}
	public static function txtCountry_TN(){ return new Lemma(__FUNCTION__
		,'en',"TUNISIA"
		,'fr',"TUNISIE"
		);}
	public static function txtCountry_TO(){ return new Lemma(__FUNCTION__
		,'en',"TONGA"
		,'fr',"TONGA"
		);}
	public static function txtCountry_TR(){ return new Lemma(__FUNCTION__
		,'en',"TURKEY"
		,'fr',"TURQUIE"
		);}
	public static function txtCountry_TT(){ return new Lemma(__FUNCTION__
		,'en',"TRINIDAD AND TOBAGO"
		,'fr',"TRINITÉ-ET-TOBAGO"
		);}
	public static function txtCountry_TV(){ return new Lemma(__FUNCTION__
		,'en',"TUVALU"
		,'fr',"TUVALU"
		);}
	public static function txtCountry_TW(){ return new Lemma(__FUNCTION__
		,'en',"TAIWAN, PROVINCE OF CHINA"
		,'fr',"TAÏWAN, PROVINCE DE CHINE"
		);}
	public static function txtCountry_TZ(){ return new Lemma(__FUNCTION__
		,'en',"TANZANIA, UNITED REPUBLIC OF"
		,'fr',"TANZANIE, RÉPUBLIQUE-UNIE DE"
		);}
	public static function txtCountry_UA(){ return new Lemma(__FUNCTION__
		,'en',"UKRAINE"
		,'fr',"UKRAINE"
		);}
	public static function txtCountry_UG(){ return new Lemma(__FUNCTION__
		,'en',"UGANDA"
		,'fr',"OUGANDA"
		);}
	public static function txtCountry_UM(){ return new Lemma(__FUNCTION__
		,'en',"UNITED STATES MINOR OUTLYING ISLANDS"
		,'fr',"ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS"
		);}
	public static function txtCountry_US(){ return new Lemma(__FUNCTION__
		,'en',"UNITED STATES"
		,'fr',"ÉTATS-UNIS"
		);}
	public static function txtCountry_UY(){ return new Lemma(__FUNCTION__
		,'en',"URUGUAY"
		,'fr',"URUGUAY"
		);}
	public static function txtCountry_UZ(){ return new Lemma(__FUNCTION__
		,'en',"UZBEKISTAN"
		,'fr',"OUZBÉKISTAN"
		);}
	public static function txtCountry_VA(){ return new Lemma(__FUNCTION__
		,'en',"HOLY SEE (VATICAN CITY STATE)"
		,'fr',"SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)"
		);}
	public static function txtCountry_VC(){ return new Lemma(__FUNCTION__
		,'en',"SAINT VINCENT AND THE GRENADINES"
		,'fr',"SAINT-VINCENT-ET-LES GRENADINES"
		);}
	public static function txtCountry_VE(){ return new Lemma(__FUNCTION__
		,'en',"VENEZUELA, BOLIVARIAN REPUBLIC OF"
		,'fr',"VENEZUELA, RÉPUBLIQUE BOLIVARIENNE DU"
		);}
	public static function txtCountry_VG(){ return new Lemma(__FUNCTION__
		,'en',"VIRGIN ISLANDS, BRITISH"
		,'fr',"ÎLES VIERGES BRITANNIQUES"
		);}
	public static function txtCountry_VI(){ return new Lemma(__FUNCTION__
		,'en',"VIRGIN ISLANDS, U.S."
		,'fr',"ÎLES VIERGES DES ÉTATS-UNIS"
		);}
	public static function txtCountry_VN(){ return new Lemma(__FUNCTION__
		,'en',"VIET NAM"
		,'fr',"VIET NAM"
		);}
	public static function txtCountry_VU(){ return new Lemma(__FUNCTION__
		,'en',"VANUATU"
		,'fr',"VANUATU"
		);}
	public static function txtCountry_WF(){ return new Lemma(__FUNCTION__
		,'en',"WALLIS AND FUTUNA"
		,'fr',"WALLIS ET FUTUNA"
		);}
	public static function txtCountry_WS(){ return new Lemma(__FUNCTION__
		,'en',"SAMOA"
		,'fr',"SAMOA"
		);}
	public static function txtCountry_YE(){ return new Lemma(__FUNCTION__
		,'en',"YEMEN"
		,'fr',"YÉMEN"
		);}
	public static function txtCountry_YT(){ return new Lemma(__FUNCTION__
		,'en',"MAYOTTE"
		,'fr',"MAYOTTE"
		);}
	public static function txtCountry_ZA(){ return new Lemma(__FUNCTION__
		,'en',"SOUTH AFRICA"
		,'fr',"AFRIQUE DU SUD"
		);}
	public static function txtCountry_ZM(){ return new Lemma(__FUNCTION__
		,'en',"ZAMBIA"
		,'fr',"ZAMBIE"
		);}
	public static function txtCountry_ZW(){ return new Lemma(__FUNCTION__
		,'en',"ZIMBABWE"
		,'fr',"ZIMBABWE"
		);}

}

