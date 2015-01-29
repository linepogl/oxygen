<?php
abstract class _oxy_dictionary extends ResourceManager {

	public static function txt_locale(){ return Lemma::txt([__FUNCTION__
		,en=>"en_GB"
		,fr=>"fr_FR"
		,el=>"el_GR"
		,de=>"de_DE"
		,es=>"es_ES"
		,it=>"it_IT"
		,pt=>"pt_BR"
		,ru=>"ru_RU"
		,zh=>"ZH_CN"
		]);}
	public static function txt_thousands_separator(){ return Lemma::txt([__FUNCTION__
		,en=>","
		,fr=>" "
		,el=>"."
		,de=>"."
		,es=>" "
		,it=>"."
		,pt=>"."
		,ru=>" "
		,zh=>","
		]);}
	public static function txt_decimal_separator(){ return Lemma::txt([__FUNCTION__
		,en=>"."
		,fr=>","
		,el=>","
		,de=>","
		,es=>","
		,it=>","
		,pt=>","
		,ru=>","
		,zh=>"."
		]);}

	public static function txtLanguage(){ return Lemma::txt([__FUNCTION__
		,en=>"Language"
		,fr=>"Langue"
		,el=>"Γλώσσα"
		,de=>"Sprache"
		,es=>"Idioma"
		,it=>"Lingua"
		,pt=>"Idioma"
		,ru=>"Язык"
		,zh=>"语言"
		]);}
	public static function txtName(){ return Lemma::txt([__FUNCTION__
		,en=>"Name"
		,fr=>"Nom"
		,el=>"Όνομα"
		,de=>"Name"
		,es=>"Nombre"
		,it=>"Nome"
		,pt=>"Nome"
		,ru=>"Имя"
		,zh=>"名字"
		]);}
	public static function txtSurname(){ return Lemma::txt([__FUNCTION__
		,en=>"Surname"
		,fr=>"Nom"
		,el=>"Επίθετο"
		,de=>"Nachname"
		,es=>"Apellido"
		,it=>"Cognome"
		,pt=>"Sobrenome"
		,ru=>"Фамилия"
		,zh=>"姓氏"
		]);}
	public static function txtFirstName(){ return Lemma::txt([__FUNCTION__
		,en=>"Name"
		,fr=>"Prénom"
		,el=>"Όνομα"
		,de=>"Vorname"
		,es=>"NombrePropio"
		,it=>"Nome"
		,pt=>"Nome"
		,ru=>"Имя"
		,zh=>"名字"
		]);}
	public static function txtCompany(){ return Lemma::txt([__FUNCTION__
		,en=>"Company"
		,fr=>"Société"
		,el=>"Εταιρία"
		,de=>"Firma"
		,es=>"Compañía"
		,it=>"Azienda"
		,pt=>"Empresa"
		,ru=>"Компания"
		,zh=>"公司"
		]);}
	public static function txtPosition(){ return Lemma::txt([__FUNCTION__
		,en=>"Position"
		,fr=>"Position"
		,el=>"Θέση"
		,de=>"Position"
		,es=>"Posición"
		,it=>"Posizione"
		,pt=>"Cargo"
		,ru=>"Должность"
		,zh=>"职位"
		]);}
	public static function txtGender(){ return Lemma::txt([__FUNCTION__
		,en=>"Gender"
		,fr=>"Sexe"
		,el=>"Φύλο"
		,de=>"Geschlecht"
		,es=>"Género"
		,it=>"Genere"
		,pt=>"Sexo"
		,ru=>"Пол"
		,zh=>"性别"
		]);}
	public static function txtMale(){ return Lemma::txt([__FUNCTION__
		,en=>"Male"
		,fr=>"Homme"
		,el=>"Άρρεν"
		,de=>"Männlich"
		,es=>"Hombre"
		,it=>"Maschio"
		,pt=>"Masculino"
		,ru=>"Мужской"
		,zh=>"男性"
		]);}
	public static function txtFemale(){ return Lemma::txt([__FUNCTION__
		,en=>"Female"
		,fr=>"Femme"
		,el=>"Θύλη"
		,de=>"Weiblich"
		,es=>"Mujer"
		,it=>"Femmina"
		,pt=>"Feminino"
		,ru=>"Женский"
		,zh=>"女性"
		]);}
	public static function txtPhone(){ return Lemma::txt([__FUNCTION__
		,en=>"Phone"
		,fr=>"Téléphone"
		,el=>"Τηλέφωνο"
		,de=>"Telefon"
		,es=>"Teléfono"
		,it=>"Telefono"
		,pt=>"Telefone"
		,ru=>"Телефон"
		,zh=>"电话"
		]);}
	public static function txtEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"E-mail"
		,fr=>"E-mail"
		,el=>"E-mail"
		,de=>"E-Mail"
		,es=>"Email"
		,it=>"Email"
		,pt=>"E-mail"
		,ru=>"Электронная почта"
		,zh=>"电子邮箱"
		]);}
	public static function txtAddress(){ return Lemma::txt([__FUNCTION__
		,en=>"Address"
		,fr=>"Adresse"
		,el=>"Διεύθυνση"
		,de=>"Adresse"
		,es=>"Dirección"
		,it=>"Indirizzo"
		,pt=>"Endereço"
		,ru=>"Адрес"
		,zh=>"地址"
		]);}
	public static function txtCity(){ return Lemma::txt([__FUNCTION__
		,en=>"City"
		,fr=>"Ville"
		,el=>"Πόλη"
		,de=>"Stadt"
		,es=>"Ciudad"
		,it=>"Città"
		,pt=>"Cidade"
		,ru=>"Город"
		,zh=>"城市"
		]);}
	public static function txtZip(){ return Lemma::txt([__FUNCTION__
		,en=>"Postal code"
		,fr=>"Code postal"
		,el=>"Τ.Κ."
		,de=>"Postleitzahl"
		,es=>"Código postal"
		,it=>"CAP"
		,pt=>"CEP"
		,ru=>"Почтовый индекс"
		,zh=>"邮编"
		]);}
	public static function txtCountry(){ return Lemma::txt([__FUNCTION__
		,en=>"Country"
		,fr=>"Pays"
		,el=>"Χώρα"
		,de=>"Land"
		,es=>"País"
		,it=>"Paese"
		,pt=>"País"
		,ru=>"Страна"
		,zh=>"国家"
		]);}
	public static function txtComments(){ return Lemma::txt([__FUNCTION__
		,en=>"Comments"
		,fr=>"Commentaires"
		,el=>"Σχόλια"
		,de=>"Kommentare"
		,es=>"Comentarios"
		,it=>"Commenti"
		,pt=>"Comentários"
		,ru=>"Комментарии"
		,zh=>"注释"
		]);}
	public static function txtUsername(){ return Lemma::txt([__FUNCTION__
		,en=>"Username"
		,fr=>"Identifiant"
		,el=>"Username"
		,de=>"Benutzername"
		,es=>"Nombre de usuario"
		,it=>"Username"
		,pt=>"Nome de Usuário"
		,ru=>"Имя пользователя"
		,zh=>"用户名"
		]);}
	public static function txtPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Password"
		,fr=>"Mot de passe"
		,el=>"Κωδικός"
		,de=>"Passwort"
		,es=>"Contraseña"
		,it=>"Password"
		,pt=>"Senha"
		,ru=>"Пароль"
		,zh=>"密码"
		]);}
	public static function txtOldPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Old password"
		,fr=>"Ancien mot de passe"
		,el=>"Παλιός κωδικός"
		,de=>"Altes Passwort"
		,es=>"Antigua Contraseña"
		,it=>"Vecchia password"
		,pt=>"Senha antiga"
		,ru=>"Старый пароль"
		,zh=>"旧密码"
		]);}
	public static function txtNewPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"New password"
		,fr=>"Nouveau mot de passe"
		,el=>"Νέος κωδικός"
		,de=>"Neues Passwort"
		,es=>"Nueva Contraseña"
		,it=>"Nuova password"
		,pt=>"Nova senha"
		,ru=>"Новый пароль"
		,zh=>"新密码"
		]);}
	public static function txtConfirmPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Confirm"
		,fr=>"Confirmer"
		,el=>"Επιβεβαίωση"
		,de=>"Passwort Bestätigen"
		,es=>"Confirmar"
		,it=>"Conferma"
		,pt=>"Confirmar"
		,ru=>"Подтверждение"
		,zh=>"确认密码"
		]);}
	public static function txtDateCreated(){ return Lemma::txt([__FUNCTION__
		,en=>"Date created"
		,fr=>"Date de création"
		,el=>"Ημ.δημιουργίας"
		,de=>"Erstellungsdatum"
		,es=>"Fecha de creación"
		,it=>"Data di creazione"
		,pt=>"Data de criação"
		,ru=>"Дата создания"
		,zh=>"创建日期"
		]);}
	public static function txtDateModified(){ return Lemma::txt([__FUNCTION__
		,en=>"Date modified"
		,fr=>"Date de modification"
		,el=>"Ημ.μεταβολής"
		,de=>"Modifizierungsdatum"
		,es=>"Fecha de modificación"
		,it=>"Data di modifica"
		,pt=>"Data de modificação"
		,ru=>"Дата изменения"
		,zh=>"修改日期"
		]);}
	public static function txtEmailRcpt(){ return Lemma::txt([__FUNCTION__
		,en=>"To"
		,fr=>"A"
		,el=>"Πρoς"
		,de=>"E-Mail-Empfänger"
		,es=>"Para"
		,it=>"A"
		,pt=>"Para"
		,ru=>"Кому"
		,zh=>"邮件接收人"
		]);}
	public static function txtEmailSubject(){ return Lemma::txt([__FUNCTION__
		,en=>"Subject"
		,fr=>"Sujet"
		,el=>"Θέμα"
		,de=>"E-Mail Betreff"
		,es=>"Asunto"
		,it=>"Oggetto"
		,pt=>"Assunto"
		,ru=>"Тема"
		,zh=>"邮件主题"
		]);}
	public static function txtEmailBody(){ return Lemma::txt([__FUNCTION__
		,en=>"Body"
		,fr=>"Message"
		,el=>"Κείμενο"
		,de=>"E-Mail Text"
		,es=>"Mensaje"
		,it=>"Messaggio"
		,pt=>"Mensagem"
		,ru=>"Основной текст"
		,zh=>"邮件主体"
		]);}
	public static function txtEmailFrom(){ return Lemma::txt([__FUNCTION__
		,en=>"From"
		,fr=>"De"
		,el=>"Από"
		,de=>"E-Mail von"
		,es=>"De"
		,it=>"Da"
		,pt=>"De"
		,ru=>"От"
		,zh=>"邮件发送人"
		]);}
	public static function txtDateSent(){ return Lemma::txt([__FUNCTION__
		,en=>"Date sent"
		,fr=>"Date d'envoi"
		,el=>"Ημ.αποστολής"
		,de=>"Gesendet am"
		,es=>"Fecha de envío"
		,it=>"Data di invio"
		,pt=>"Data de envio"
		,ru=>"Дата отправки"
		,zh=>"发送日期"
		]);}
	public static function txtLockedAccount(){ return Lemma::txt([__FUNCTION__
		,en=>"Locked account"
		,fr=>"Compte bloqué"
		,el=>"Κλειδωμένος λογαριασμός"
		,de=>"Gesperrtes Konto"
		,es=>"Cuenta Bloqueada"
		,it=>"Conto bloccato"
		,pt=>"Conta bloqueada"
		,ru=>"Заблокированный аккаунт"
		,zh=>"被锁帐户"
		]);}
	public static function txtFile(){ return Lemma::txt([__FUNCTION__
		,en=>"File"
		,fr=>"Fichier"
		,el=>"Αρχείο"
		,de=>"Datei"
		,es=>"Archivo"
		,it=>"File"
		,pt=>"Arquivo"
		,ru=>"Файл"
		,zh=>"文件"
		]);}
	public static function txtFiles(){ return Lemma::txt([__FUNCTION__
		,en=>"Files"
		,fr=>"Fichiers"
		,el=>"Αρχεία"
		]);}



	public static function txtDate(){ return Lemma::txt([__FUNCTION__
		,en=>"Date"
		,fr=>"Date"
		,el=>"Ημερομηνία"
		,de=>"Datum"
		,es=>"Fecha"
		,it=>"Data"
		,pt=>"Data"
		,ru=>"Дата"
		,zh=>"日期"
		]);}
	public static function txtTime(){ return Lemma::txt([__FUNCTION__
		,en=>"Time"
		,fr=>"Heure"
		,el=>"Ώρα"
		,de=>"Zeit"
		,es=>"Hora"
		,it=>"Ora"
		,pt=>"Hora "
		,ru=>"Время"
		,zh=>"时间"
		]);}
	public static function txtToday(){ return Lemma::txt([__FUNCTION__
		,en=>"Today"
		,fr=>"Aujourd'hui"
		,el=>"Σήμερα"
		,de=>"Heute"
		,es=>"Hoy"
		,it=>"Oggi"
		,pt=>"Hoje"
		,ru=>"Сегодня"
		,zh=>"今天"
		]);}
	public static function txtTomorrow(){ return Lemma::txt([__FUNCTION__
		,en=>"Tomorrow"
		,fr=>"Demain"
		,el=>"Αύριο"
		,de=>"Morgen"
		,es=>"Mañana"
		,it=>"Domani"
		,pt=>"Amanhã"
		,ru=>"Завтра"
		,zh=>"明天"
		]);}
	public static function txtYesterday(){ return Lemma::txt([__FUNCTION__
		,en=>"Yesterday"
		,fr=>"Hier"
		,el=>"Xθες"
		,de=>"Gestern"
		,es=>"Ayer"
		,it=>"Ieri"
		,pt=>"Ontem"
		,ru=>"Вчера"
		,zh=>"昨天"
		]);}
	public static function txtNow(){ return Lemma::txt([__FUNCTION__
		,en=>"Now"
		,fr=>"Maintenant"
		,el=>"Τώρα"
		,de=>"Jetzt"
		,es=>"Ahora"
		,it=>"Ora"
		,pt=>"Agora"
		,ru=>"Сейчас"
		,zh=>"现在"
		]);}
	public static function txtAM(){ return Lemma::txt([__FUNCTION__
		,en=>"a.m."
		,fr=>"avant-midi"
		,el=>"π.μ."
		,de=>"Uhr"
		,es=>"a. m."
		,it=>"AM"
		,pt=>"AM"
		,ru=>"До полудня"
		,zh=>"上午"
		]);}
	public static function txtPM(){ return Lemma::txt([__FUNCTION__
		,en=>"p.m."
		,fr=>"après-midi"
		,el=>"μ.μ."
		,de=>"Uhr"
		,es=>"p. m."
		,it=>"PM"
		,pt=>"PM"
		,ru=>"После полудня"
		,zh=>"下午"
		]);}
	public static function txtDay(){ return Lemma::txt([__FUNCTION__
		,en=>"Day"
		,fr=>"Jour"
		,el=>"Ημέρα"
		,de=>"Tag"
		,es=>"Día"
		,it=>"Giorno"
		,pt=>"Dia"
		,ru=>"День"
		,zh=>"白天"
		]);}
	public static function txtDayOfWeek(){ return Lemma::txt([__FUNCTION__
		,en=>"Day of week"
		,fr=>"Jour de la semaine"
		,el=>"Ημέρα της εβδομάδας"
		,de=>"Wochentag"
		,es=>"Día De La Semana"
		,it=>"GiornoDellaSettimana"
		,pt=>"Dia da semana"
		,ru=>"День недели"
		,zh=>"平日"
		]);}
	public static function txtNight(){ return Lemma::txt([__FUNCTION__
		,en=>"Night"
		,fr=>"Nuit"
		,el=>"Νύχτα"
		,de=>"Nacht"
		,es=>"Noche"
		,it=>"Notte"
		,pt=>"Noite"
		,ru=>"Ночь"
		,zh=>"晚上"
		]);}
	public static function txtDays(){ return Lemma::txt([__FUNCTION__
		,en=>"Days"
		,fr=>"Jours"
		,el=>"Ημέρες"
		,de=>"Tage"
		,es=>"Días"
		,it=>"Giorni"
		,pt=>"Dias"
		,ru=>"Дни"
		,zh=>"天"
		]);}
	public static function txtXDays(){ return Lemma::txt([__FUNCTION__
		,en=>"%s days"
		,fr=>"%s jours"
		,el=>"%s ημέρες"
		,de=>"e%s Tage "
		,es=>"%s días"
		,it=>"%s giorni"
		,pt=>"% dias"
		,ru=>"%s дней"
		,zh=>"%s 天"
		]);}
	public static function txtXDaysAgo(){ return Lemma::txt([__FUNCTION__
		,en=>"%s days ago"
		,fr=>"Il y a %s jours"
		,el=>"Πριν από %s ημέρες"
		,de=>"Vor % Tagen"
		,es=>"Hace %s Días"
		,it=>"%s giorni fa"
		,pt=>"% dias atrás"
		,ru=>"%s дней назад"
		,zh=>"%s 天前"
		]);}
	public static function txtXTimeAgo(){ return Lemma::txt([__FUNCTION__
		,en=>"%s ago"
		,fr=>"Il y a %s"
		,el=>"Πριν από %s"
		,de=>"Vor %s"
		,es=>"Hace %s"
		,it=>"%s fa"
		,pt=>"% tempo"
		,ru=>"%s назад"
		,zh=>"%s前"
		]);}
	public static function txtInXDays(){ return Lemma::txt([__FUNCTION__
		,en=>"In %s days"
		,fr=>"Dans %s jours"
		,el=>"Σε %s ημέρες"
		,de=>"In % Tagen"
		,es=>"En %s días"
		,it=>"Fra %s giorni"
		,pt=>"Em % dias"
		,ru=>"За %s дней"
		,zh=>"在%s 天后"
		]);}
	public static function txtInXTime(){ return Lemma::txt([__FUNCTION__
		,en=>"In %s"
		,fr=>"Dans %s"
		,el=>"Σε %s"
		,de=>"In%s"
		,es=>"En %s"
		,it=>"Fra %s"
		,pt=>"Em %"
		,ru=>"За %s"
		,zh=>"在 %s 内"
		]);}
	public static function txtTimeZone(){ return Lemma::txt([__FUNCTION__
		,en=>"Time zone"
		,fr=>"Fuseau horaire"
		,el=>"Ζώνη ώρας"
		,de=>"Zeitzone"
		,es=>"Zona Horaria"
		,it=>"Fuso orario"
		,pt=>"Fuso horário"
		,ru=>"Часовой пояс"
		,zh=>"时区"
		]);}
	public static function txtJanuary(){ return Lemma::txt([__FUNCTION__
		,en=>"January"
		,fr=>"janvier"
		,el=>"Ιανουάριος"
		,de=>"Januar"
		,es=>"enero"
		,it=>"Gennaio"
		,pt=>"Janeiro"
		,ru=>"Январь"
		,zh=>"一月"
		]);}
	public static function txtFebruary(){ return Lemma::txt([__FUNCTION__
		,en=>"February"
		,fr=>"février"
		,el=>"Φεβρουάριος"
		,de=>"Februar"
		,es=>"febrero"
		,it=>"Febbraio"
		,pt=>"Fevereiro"
		,ru=>"Февраль"
		,zh=>"二月"
		]);}
	public static function txtMarch(){ return Lemma::txt([__FUNCTION__
		,en=>"March"
		,fr=>"mars"
		,el=>"Μάρτιος"
		,de=>"März"
		,es=>"marzo"
		,it=>"Marzo"
		,pt=>"Março"
		,ru=>"Март"
		,zh=>"三月"
		]);}
	public static function txtApril(){ return Lemma::txt([__FUNCTION__
		,en=>"April"
		,fr=>"avril"
		,el=>"Απρίλιος"
		,de=>"April"
		,es=>"abril"
		,it=>"Aprile"
		,pt=>"Abril"
		,ru=>"Апрель"
		,zh=>"四月"
		]);}
	public static function txtMay(){ return Lemma::txt([__FUNCTION__
		,en=>"May"
		,fr=>"mai"
		,el=>"Μάιος"
		,de=>"Mai"
		,es=>"mayo"
		,it=>"Maggio"
		,pt=>"Maio"
		,ru=>"Май"
		,zh=>"五月"
		]);}
	public static function txtJune(){ return Lemma::txt([__FUNCTION__
		,en=>"June"
		,fr=>"juin"
		,el=>"Ιούνιος"
		,de=>"Juni"
		,es=>"junio"
		,it=>"Giugno"
		,pt=>"Junho"
		,ru=>"Июнь"
		,zh=>"六月"
		]);}
	public static function txtJuly(){ return Lemma::txt([__FUNCTION__
		,en=>"July"
		,fr=>"juillet"
		,el=>"Ιούλιος"
		,de=>"Juli"
		,es=>"julio"
		,it=>"Luglio"
		,pt=>"Julho"
		,ru=>"Июль"
		,zh=>"七月"
		]);}
	public static function txtAugust(){ return Lemma::txt([__FUNCTION__
		,en=>"August"
		,fr=>"août"
		,el=>"Αύγουστος"
		,de=>"August"
		,es=>"agosto"
		,it=>"Agosto"
		,pt=>"Agosto"
		,ru=>"Август"
		,zh=>"八月"
		]);}
	public static function txtSeptember(){ return Lemma::txt([__FUNCTION__
		,en=>"September"
		,fr=>"septembre"
		,el=>"Σεπτέμβριος"
		,de=>"September"
		,es=>"septiembre"
		,it=>"Settembre"
		,pt=>"Setembro"
		,ru=>"Сентябрь"
		,zh=>"九月"
		]);}
	public static function txtOctober(){ return Lemma::txt([__FUNCTION__
		,en=>"October"
		,fr=>"octobre"
		,el=>"Οκτώβριος"
		,de=>"Oktober"
		,es=>"octubre"
		,it=>"Ottobre"
		,pt=>"Outubro"
		,ru=>"Октябрь"
		,zh=>"十月"
		]);}
	public static function txtNovember(){ return Lemma::txt([__FUNCTION__
		,en=>"November"
		,fr=>"novembre"
		,el=>"Νοέμβριος"
		,de=>"November"
		,es=>"noviembre"
		,it=>"Novembre"
		,pt=>"Novembro"
		,ru=>"Ноябрь"
		,zh=>"十一月"
		]);}
	public static function txtDecember(){ return Lemma::txt([__FUNCTION__
		,en=>"December"
		,fr=>"décembre"
		,el=>"Δεκέμβριος"
		,de=>"Dezember"
		,es=>"diciembre"
		,it=>"Dicembre"
		,pt=>"Dezembro"
		,ru=>"Декабрь"
		,zh=>"十二月"
		]);}

	public static function txtJan_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jan"
		,fr=>"jan."
		,el=>"Ιαν."
		,de=>"Jan"
		,es=>"ene."
		,it=>"Gen"
		,pt=>"Jan"
		,ru=>"Янв"
		,zh=>"一月"
		]);}
	public static function txtFeb_(){ return Lemma::txt([__FUNCTION__
		,en=>"Feb"
		,fr=>"fév."
		,el=>"Φεβ."
		,de=>"Feb."
		,es=>"feb."
		,it=>"Feb"
		,pt=>"Fev"
		,ru=>"Фев"
		,zh=>"二月"
		]);}
	public static function txtMar_(){ return Lemma::txt([__FUNCTION__
		,en=>"Mar"
		,fr=>"mars"
		,el=>"Μάρ."
		,de=>"Mar."
		,es=>"mar."
		,it=>"Mar"
		,pt=>"Mar"
		,ru=>"Мар"
		,zh=>"三月"
		]);}
	public static function txtApr_(){ return Lemma::txt([__FUNCTION__
		,en=>"Apr"
		,fr=>"avr."
		,el=>"Απρ."
		,de=>"Apr."
		,es=>"abr."
		,it=>"Apr"
		,pt=>"Abr"
		,ru=>"Апр"
		,zh=>"四月"
		]);}
	public static function txtMay_(){ return Lemma::txt([__FUNCTION__
		,en=>"May"
		,fr=>"mai"
		,el=>"Μάι."
		,de=>"Mai"
		,es=>"may."
		,it=>"Mag"
		,pt=>"Mai"
		,ru=>"Май"
		,zh=>"五月"
		]);}
	public static function txtJun_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jun"
		,fr=>"juin"
		,el=>"Ιούν."
		,de=>"Jun."
		,es=>"jun."
		,it=>"Giu"
		,pt=>"Jun"
		,ru=>"Июн"
		,zh=>"六月"
		]);}
	public static function txtJul_(){ return Lemma::txt([__FUNCTION__
		,en=>"Jul"
		,fr=>"juil"
		,el=>"Ιούλ."
		,de=>"Jul."
		,es=>"jul."
		,it=>"Lug"
		,pt=>"Jul"
		,ru=>"Июл"
		,zh=>"七月"
		]);}
	public static function txtAug_(){ return Lemma::txt([__FUNCTION__
		,en=>"Aug"
		,fr=>"août"
		,el=>"Αύγ."
		,de=>"Aug."
		,es=>"ago."
		,it=>"Ago"
		,pt=>"Ago"
		,ru=>"Авг"
		,zh=>"八月"
		]);}
	public static function txtSep_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sep"
		,fr=>"sep."
		,el=>"Σεπ."
		,de=>"Sept."
		,es=>"sep."
		,it=>"Set"
		,pt=>"Set"
		,ru=>"Сен"
		,zh=>"九月"
		]);}
	public static function txtOct_(){ return Lemma::txt([__FUNCTION__
		,en=>"Oct"
		,fr=>"oct."
		,el=>"Οκτ."
		,de=>"Okt."
		,es=>"oct."
		,it=>"Ott"
		,pt=>"Out"
		,ru=>"Окт"
		,zh=>"十月"
		]);}
	public static function txtNov_(){ return Lemma::txt([__FUNCTION__
		,en=>"Nov"
		,fr=>"nov."
		,el=>"Νοέ."
		,de=>"Nov."
		,es=>"nov."
		,it=>"Nov"
		,pt=>"Nov"
		,ru=>"Ноя"
		,zh=>"十一月"
		]);}
	public static function txtDec_(){ return Lemma::txt([__FUNCTION__
		,en=>"Dec"
		,fr=>"déc."
		,el=>"Δεκ."
		,de=>"Dez."
		,es=>"dic."
		,it=>"Dic"
		,pt=>"Dez"
		,ru=>"Дек"
		,zh=>"十二月"
		]);}

	public static function txtMonday(){ return Lemma::txt([__FUNCTION__
		,en=>"Monday"
		,fr=>"lundi"
		,el=>"Δευτέρα"
		,de=>"Montag"
		,es=>"lunes"
		,it=>"Lunedì"
		,pt=>"Segunda-feira"
		,ru=>"Понедельник"
		,zh=>"星期一"
		]);}
	public static function txtTuesday(){ return Lemma::txt([__FUNCTION__
		,en=>"Tuesday"
		,fr=>"mardi"
		,el=>"Τρίτη"
		,de=>"Dienstag"
		,es=>"martes"
		,it=>"Martedì"
		,pt=>"Terça-feira"
		,ru=>"Вторник"
		,zh=>"星期二"
		]);}
	public static function txtWednesday(){ return Lemma::txt([__FUNCTION__
		,en=>"Wednesday"
		,fr=>"mercredi"
		,el=>"Τετάρτη"
		,de=>"Mitwoch"
		,es=>"miércoles"
		,it=>"Mercoledì"
		,pt=>"Quarta-feira"
		,ru=>"Среда"
		,zh=>"星期三"
		]);}
	public static function txtThursday(){ return Lemma::txt([__FUNCTION__
		,en=>"Thursday"
		,fr=>"jeudi"
		,el=>"Πέμπτη"
		,de=>"Donnerstag"
		,es=>"jueves"
		,it=>"Giovedì"
		,pt=>"Quinta-feira"
		,ru=>"Четверг"
		,zh=>"星期四"
		]);}
	public static function txtFriday(){ return Lemma::txt([__FUNCTION__
		,en=>"Friday"
		,fr=>"vendredi"
		,el=>"Παρασκευή"
		,de=>"Freitag"
		,es=>"viernes"
		,it=>"Venerdì"
		,pt=>"Sexta-feira"
		,ru=>"Пятница"
		,zh=>"星期五"
		]);}
	public static function txtSaturday(){ return Lemma::txt([__FUNCTION__
		,en=>"Saturday"
		,fr=>"samedi"
		,el=>"Σάββατο"
		,de=>"Samstag"
		,es=>"sábado"
		,it=>"Sabato"
		,pt=>"Sábado"
		,ru=>"Суббота"
		,zh=>"星期六"
		]);}
	public static function txtSunday(){ return Lemma::txt([__FUNCTION__
		,en=>"Sunday"
		,fr=>"dimanche"
		,el=>"Κυριακή"
		,de=>"Sonntag"
		,es=>"domingo"
		,it=>"Domenica"
		,pt=>"Domingo"
		,ru=>"Воскресенье"
		,zh=>"星期天"
		]);}

	public static function txtMon_(){ return Lemma::txt([__FUNCTION__
		,en=>"Mon"
		,fr=>"lun."
		,el=>"Δευ."
		,de=>"Mo_"
		,es=>"lun."
		,it=>"Lun"
		,pt=>"Seg"
		,ru=>"Пн"
		,zh=>"周一"
		]);}
	public static function txtTue_(){ return Lemma::txt([__FUNCTION__
		,en=>"Tue"
		,fr=>"mar."
		,el=>"Τρί."
		,de=>"Di_"
		,es=>"mar."
		,it=>"Mar"
		,pt=>"Ter"
		,ru=>"Вт"
		,zh=>"周二"
		]);}
	public static function txtWed_(){ return Lemma::txt([__FUNCTION__
		,en=>"Wed"
		,fr=>"mer."
		,el=>"Τετ."
		,de=>"Mi_"
		,es=>"mié."
		,it=>"Mer"
		,pt=>"Qua"
		,ru=>"Ср"
		,zh=>"周三"
		]);}
	public static function txtThu_(){ return Lemma::txt([__FUNCTION__
		,en=>"Thu"
		,fr=>"jeu."
		,el=>"Πέμ."
		,de=>"Do_"
		,es=>"jue."
		,it=>"Gio"
		,pt=>"Qui"
		,ru=>"Чт"
		,zh=>"周四"
		]);}
	public static function txtFri_(){ return Lemma::txt([__FUNCTION__
		,en=>"Fri"
		,fr=>"ven."
		,el=>"Παρ."
		,de=>"F_"
		,es=>"vie."
		,it=>"Ven"
		,pt=>"Sex"
		,ru=>"Пт"
		,zh=>"周五"
		]);}
	public static function txtSat_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sat"
		,fr=>"sam."
		,el=>"Σάβ."
		,de=>"Sa_"
		,es=>"sáb."
		,it=>"Sab"
		,pt=>"Sáb"
		,ru=>"Сб"
		,zh=>"周六"
		]);}
	public static function txtSun_(){ return Lemma::txt([__FUNCTION__
		,en=>"Sun"
		,fr=>"dim."
		,el=>"Κυρ."
		,de=>"So_"
		,es=>"dom."
		,it=>"Dom"
		,pt=>"Dom"
		,ru=>"Вс"
		,zh=>"周天"
		]);}





	public static function txtSubmit(){ return Lemma::txt([__FUNCTION__
		,en=>"Submit"
		,fr=>"Soumettre"
		,el=>"Αποστολή"
		,de=>"Absenden"
		,es=>"Enviar"
		,it=>"Invia"
		,pt=>"Enviar"
		,ru=>"Отправить"
		,zh=>"提交"
		]);}
	public static function txtLogin(){ return Lemma::txt([__FUNCTION__
		,en=>"Login"
		,fr=>"Connexion"
		,el=>"Login"
		,de=>"Anmeldung"
		,es=>"Acceder"
		,it=>"Accedi"
		,pt=>"Entrar"
		,ru=>"Вход"
		,zh=>"登录"
		]);}
	public static function txtLogoff(){ return Lemma::txt([__FUNCTION__
		,en=>"Logoff"
		,fr=>"Déconnexion"
		,el=>"Logoff"
		,de=>"Abmeldung"
		,es=>"Salir"
		,it=>"Esci"
		,pt=>"Sair"
		,ru=>"Выход"
		,zh=>"退出"
		]);}
	public static function txtBack(){ return Lemma::txt([__FUNCTION__
		,en=>"Back"
		,fr=>"Retour"
		,el=>"Επιστροφή"
		,de=>"Zurück"
		,es=>"Atrás"
		,it=>"Indietro"
		,pt=>"Voltar"
		,ru=>"Назад"
		,zh=>"后退"
		]);}
	public static function txtOK(){ return Lemma::txt([__FUNCTION__
		,en=>"OK"
		,fr=>"OK"
		,el=>"OK"
		,de=>"OK"
		,es=>"OK"
		,it=>"OK"
		,pt=>"OK"
		,ru=>"OK"
		,zh=>"确定"
		]);}
	public static function txtApply(){ return Lemma::txt([__FUNCTION__
		,en=>"Apply"
		,fr=>"Appliquer"
		,el=>"Εφαρμογή"
		,de=>"Anwenden"
		,es=>"Aplicar"
		,it=>"Applica"
		,pt=>"Aplicar"
		,ru=>"Применить"
		,zh=>"应用"
		]);}
	public static function txtCancel(){ return Lemma::txt([__FUNCTION__
		,en=>"Cancel"
		,fr=>"Annuler"
		,el=>"Άκυρο"
		,de=>"Abbrechen"
		,es=>"Cancelar"
		,it=>"Annulla"
		,pt=>"Cancelar"
		,ru=>"Отменить"
		,zh=>"取消"
		]);}
	public static function txtSend(){ return Lemma::txt([__FUNCTION__
		,en=>"Send"
		,fr=>"Envoyer"
		,el=>"Αποστολή"
		,de=>"Senden"
		,es=>"Enviar"
		,it=>"Invia"
		,pt=>"Enviar"
		,ru=>"Отправить"
		,zh=>"发送"
		]);}
	public static function txtSave(){ return Lemma::txt([__FUNCTION__
		,en=>"Save"
		,fr=>"Sauvegarder"
		,el=>"Αποθήκευση"
		,de=>"Speichern"
		,es=>"Guardar"
		,it=>"Salva"
		,pt=>"Salvar"
		,ru=>"Сохранить"
		,zh=>"保存"
		]);}
	public static function txtDelete(){ return Lemma::txt([__FUNCTION__
		,en=>"Delete"
		,fr=>"Supprimer"
		,el=>"Διαγραφή"
		,de=>"Löschen"
		,es=>"Eliminar"
		,it=>"Elimina"
		,pt=>"Excluir"
		,ru=>"Удалить"
		,zh=>"删除"
		]);}
	public static function txtRename(){ return Lemma::txt([__FUNCTION__
		,en=>"Rename"
		,fr=>"Renommer"
		,el=>"Μετονομασία"
		,de=>"Umbenennen"
		,es=>"Renombrar"
		,it=>"Rinomina"
		,pt=>"Renomear"
		,ru=>"Переименовать"
		,zh=>"重命名"
		]);}
	public static function txtPrint(){ return Lemma::txt([__FUNCTION__
		,en=>"Print"
		,fr=>"Imprimer"
		,el=>"Εκτύπωση"
		,de=>"Drucken"
		,es=>"Imprimir"
		,it=>"Stampa"
		,pt=>"Imprimir"
		,ru=>"Напечатать"
		,zh=>"打印"
		]);}
	public static function txtClose(){ return Lemma::txt([__FUNCTION__
		,en=>"Close"
		,fr=>"Fermer"
		,el=>"Κλείσιμο"
		,de=>"Schließen"
		,es=>"Cerrar"
		,it=>"Chiudi"
		,pt=>"Fechar"
		,ru=>"Закрыть"
		,zh=>"关闭"
		]);}
	public static function txtAsk(){ return Lemma::txt([__FUNCTION__
		,en=>"Ask"
		,fr=>"Demander"
		,el=>"Ερώτηση"
		,de=>"Fragen"
		,es=>"Preguntar"
		,it=>"Chiedi"
		,pt=>"Perguntar"
		,ru=>"Спросить"
		,zh=>"询问"
		]);}
	public static function txtUpdate(){ return Lemma::txt([__FUNCTION__
		,en=>"Update"
		,fr=>"Mettre à jour"
		,el=>"Ανανέωση"
		,de=>"Aktualisieren"
		,es=>"Actualizar"
		,it=>"Aggiorna"
		,pt=>"Atualizar"
		,ru=>"Обновить"
		,zh=>"更新"
		]);}
	public static function txtSelect(){ return Lemma::txt([__FUNCTION__
		,en=>"Select"
		,fr=>"Sélectionner"
		,el=>"Επιλογή"
		,de=>"Wählen"
		,es=>"Seleccionar"
		,it=>"Seleziona"
		,pt=>"Selecionar"
		,ru=>"Выбрать"
		,zh=>"选择"
		]);}
	public static function txtCompare(){ return Lemma::txt([__FUNCTION__
		,en=>"Compare"
		,fr=>"Comparer"
		,el=>"Σύγκριση"
		,de=>"Vergleichen"
		,es=>"Comparar"
		,it=>"Confronta"
		,pt=>"Comparar"
		,ru=>"Сравнить"
		,zh=>"对比"
		]);}
	public static function txtSearch(){ return Lemma::txt([__FUNCTION__
		,en=>"Search"
		,fr=>"Rechercher"
		,el=>"Αναζήτηση"
		,de=>"Suchen"
		,es=>"Buscar"
		,it=>"Cerca"
		,pt=>"Procurar"
		,ru=>"Поиск"
		,zh=>"搜索"
		]);}
	public static function txtYes(){ return Lemma::txt([__FUNCTION__
		,en=>"Yes"
		,fr=>"Oui"
		,el=>"Ναι"
		,de=>"Ja"
		,es=>"Sí"
		,it=>"Sì"
		,pt=>"Sim"
		,ru=>"Да"
		,zh=>"是"
		]);}
	public static function txtNo(){ return Lemma::txt([__FUNCTION__
		,en=>"No"
		,fr=>"Non"
		,el=>"Όχι"
		,de=>"Nein"
		,es=>"No"
		,it=>"No"
		,pt=>"Não"
		,ru=>"Нет"
		,zh=>"否"
		]);}
	public static function txtNext(){ return Lemma::txt([__FUNCTION__
		,en=>"Next"
		,fr=>"Suivant"
		,el=>"Επόμενο"
		,de=>"Weiter"
		,es=>"Siguiente"
		,it=>"Avanti"
		,pt=>"Próximo"
		,ru=>"Далее"
		,zh=>"下一步"
		]);}
	public static function txtPrevious(){ return Lemma::txt([__FUNCTION__
		,en=>"Previous"
		,fr=>"Précédent"
		,el=>"Προηγούμενο"
		,de=>"Vorherige"
		,es=>"Anterior"
		,it=>"Precedente"
		,pt=>"Anterior"
		,ru=>"Предыдущий"
		,zh=>"上一步"
		]);}
	public static function txtModify(){ return Lemma::txt([__FUNCTION__
		,en=>"Modify"
		,fr=>"Modifier"
		,el=>"Επεξεργασία"
		,de=>"Ändern"
		,es=>"Modificar"
		,it=>"Modifica"
		,pt=>"Modificar"
		,ru=>"Изменить"
		,zh=>"修改"
		]);}
	public static function txtContinue(){ return Lemma::txt([__FUNCTION__
		,en=>"Continue"
		,fr=>"Continuer"
		,el=>"Συνέχεια"
		,de=>"Fortfahren"
		,es=>"Continuar"
		,it=>"Continua"
		,pt=>"Continuar"
		,ru=>"Продолжить"
		,zh=>"继续"
		]);}

	public static function txtHome(){ return Lemma::txt([__FUNCTION__
		,en=>"Home"
		,fr=>"Accueil"
		,el=>"Αρχική"
		,de=>"Startseite"
		,es=>"Inicio"
		,it=>"Home"
		,pt=>"Início"
		,ru=>"Домой"
		,zh=>"主页"
		]);}
	public static function txtSettings(){ return Lemma::txt([__FUNCTION__
		,en=>"Settings"
		,fr=>"Paramètres"
		,el=>"Ρυθμίσεις"
		,de=>"Einstellungen"
		,es=>"Ajustes"
		,it=>"Impostazioni"
		,pt=>"Configurações"
		,ru=>"Настройки"
		,zh=>"设置"
		]);}


	public static function txtUser(){ return Lemma::txt([__FUNCTION__
		,en=>"User"
		,fr=>"Utilisateur"
		,el=>"Χρήστης"
		,de=>"Benutzer"
		,es=>"Usuario"
		,it=>"Utente"
		,pt=>"Usuário"
		,ru=>"Пользователь"
		,zh=>"用户"
		]);}
	public static function txtUsers(){ return Lemma::txt([__FUNCTION__
		,en=>"Users"
		,fr=>"Utilisateurs"
		,el=>"Χρήστες"
		,de=>"Benutzer"
		,es=>"Usuarios"
		,it=>"Utenti"
		,pt=>"Usuários"
		,ru=>"Пользователи"
		,zh=>"用户"
		]);}
	public static function txtChangePassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Change password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort ändern"
		,es=>"Cambiar Contraseña"
		,it=>"Cambia la password"
		,pt=>"Alterar senha"
		,ru=>"Изменить пароль"
		,zh=>"更改密码"
		]);}
	public static function txtResetPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort zurücksetzen"
		,es=>"Restablecer Contraseña"
		,it=>"Ripristina la password"
		,pt=>"Redefinir senha"
		,ru=>"Сменить пароль"
		,zh=>"重置密码"
		]);}
	public static function txtResetPasswordLong(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset password"
		,fr=>"Réinitialiser le mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort zurücksetzen"
		,es=>"Restablecer Contraseña"
		,it=>"Ripristina la password"
		,pt=>"Redefinir senha longa"
		,ru=>"Сбросить пароль"
		,zh=>"重置密码"
		]);}
	public static function txtReset(){ return Lemma::txt([__FUNCTION__
		,en=>"Reset"
		,fr=>"Réinitialiser"
		,el=>"Αλλαγή"
		,de=>"Zurücksetzen"
		,es=>"Restablecer"
		,it=>"Ripristina"
		,pt=>"Redefinir"
		,ru=>"Сбросить"
		,zh=>"重置"
		]);}
	public static function txtChangeProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Change profile"
		,fr=>"Profil"
		,el=>"Αλλαγή προφίλ"
		,de=>"Profil wechseln"
		,es=>"Cambiar Perfil"
		,it=>"Cambia il profilo"
		,pt=>"Alterar perfil"
		,ru=>"Сменить профиль"
		,zh=>"更改个人资料"
		]);}
	public static function txtModifyProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Modify profile"
		,fr=>"Modifier profil"
		,el=>"Αλλαγή προφίλ"
		,de=>"Profil ändern"
		,es=>"Modificar Perfil"
		,it=>"Modifica il profilo"
		,pt=>"Modificar perfil"
		,ru=>"Изменить профиль"
		,zh=>"修改个人资料"
		]);}

	public static function txtError(){ return Lemma::txt([__FUNCTION__
		,en=>"Error"
		,fr=>"Erreur"
		,el=>"Σφάλμα"
		,de=>"Fehler"
		,es=>"Error"
		,it=>"Errore"
		,pt=>"Erro"
		,ru=>"Ошибка"
		,zh=>"错误"
		]);}

	public static function txtActionLogin(){ return Lemma::txt([__FUNCTION__
		,en=>"Login"
		,fr=>"Connexion"
		,el=>"Login"
		,de=>"Anmeldung"
		,es=>"Acceder"
		,it=>"Accedi"
		,pt=>"Entrar"
		,ru=>"Вход"
		,zh=>"登录"
		]);}
	public static function txtActionLogoff(){ return Lemma::txt([__FUNCTION__
		,en=>"Logoff"
		,fr=>"Déconnexion"
		,el=>"Logoff"
		,de=>"Abmeldung"
		,es=>"Salir"
		,it=>"Esci"
		,pt=>"Sair"
		,ru=>"Выход"
		,zh=>"退出"
		]);}
	public static function txtActionChangePassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Change password"
		,fr=>"Mot de passe"
		,el=>"Αλλαγή κωδικού"
		,de=>"Passwort ändern"
		,es=>"Cambiar Contraseña"
		,it=>"Cambia la password"
		,pt=>"Alterar a senha"
		,ru=>"Изменить пароль"
		,zh=>"更改密码"
		]);}
	public static function txtActionChangeProfile(){ return Lemma::txt([__FUNCTION__
		,en=>"Change profile"
		,fr=>"Profil d'utilisateur"
		,el=>"Προφίλ χρήστη"
		,de=>"Profil wechseln"
		,es=>"Perfil de susuario"
		,it=>"Cambia il profilo"
		,pt=>"Alterar o perfil"
		,ru=>"Изменить профиль"
		,zh=>"更改个人资料"
		]);}
	public static function txtActionCreateUser(){ return Lemma::txt([__FUNCTION__
		,en=>"Create user"
		,fr=>"Création d'un utilisateur"
		,el=>"Δημιουργία χρήστη"
		,de=>"Benutzer erstellen"
		,es=>"Crear Usuario"
		,it=>"Crea un utente"
		,pt=>"Criar usuário"
		,ru=>"Создать пользователя"
		,zh=>"创建用户"
		]);}
	public static function txtActionForgottenPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Forgotten your password?"
		,fr=>"Mot de passe oublié ?"
		,el=>"Υπενθύμιση κωδικού"
		,de=>"Passwort vergessen"
		,es=>"¿Olvidó su contraseña?"
		,it=>"Hai dimenticato la password?"
		,pt=>"Esqueceu sua senha?"
		,ru=>"Забыли пароль?"
		,zh=>"忘记密码？"
		]);}

	public static function txtMsgCannotDisplayWebPage(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot display the web page."
		,fr=>"La page ne peut pas être affichée."
		,el=>"Η προβολή της σελίδας δεν είναι δυνατή."
		,de=>"Website kann nicht angezeigt werden"
		,es=>"No se puede mostrar la página"
		,it=>"Impossibile mostrare la pagina web."
		,pt=>"Não é possível exibir a página da Web."
		,ru=>"Не удается отобразить веб-страницу."
		,zh=>"无法显示网页。"
		]);}
	public static function txtMsgUnderConstruction(){ return Lemma::txt([__FUNCTION__
		,en=>"Under construction."
		,fr=>"En construction."
		,el=>"Υπό κατασκευή."
		,de=>"Im Aufbau"
		,es=>"En construcción."
		,it=>"In costruzione."
		,pt=>"Em construção."
		,ru=>"В разработке."
		,zh=>"建设中。"
		]);}
	public static function txtMsgNotImplemented(){ return Lemma::txt([__FUNCTION__
		,en=>"Not implemented."
		,fr=>"Non implémenté."
		,el=>"Μη υλοποιημένο."
		,de=>"Nicht implementiert"
		,es=>"No Implementado"
		,it=>"Non implementato."
		,pt=>"Não implementado."
		,ru=>"Не реализовано."
		,zh=>"尚未实施。"
		]);}
	public static function txtMsgPageNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Page not found."
		,fr=>"La page n'était pas trouvée."
		,el=>"Η σελίδα δεν βρέθηκε."
		,de=>"Seite nicht gefunden"
		,es=>"Página No Encontrada"
		,it=>"Pagina non trovata."
		,pt=>"Página não encontrada."
		,ru=>"Страница не найдена."
		,zh=>"页面未找到。"
		]);}
	public static function txtMsgObjectNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Object not found."
		,fr=>"L'objet n'était pas trouvé."
		,el=>"Το αντικείμενο δεν βρέθηκε."
		,de=>"Objekt nicht gefunden"
		,es=>"Objeto No Encontrado"
		,it=>"Oggetto non trovato."
		,pt=>"Objeto não encontrado."
		,ru=>"Объект не найден."
		,zh=>"未找到对象。"
		]);}
	public static function txtMsgAccessDenied(){ return Lemma::txt([__FUNCTION__
		,en=>"Access denied."
		,fr=>"Accès refusé."
		,el=>"Μη επιτρεπτή πρόσβαση."
		,de=>"Zugriff verweigert"
		,es=>"Acceso Denegado"
		,it=>"Accesso negato"
		,pt=>"Acesso negado."
		,ru=>"Доступ запрещен."
		,zh=>"访问被拒绝。"
		]);}
	public static function txtMsgInvalidUsername(){ return Lemma::txt([__FUNCTION__
		,en=>"Unknown user."
		,fr=>"Utilisateur inconnu."
		,el=>"Λάθος όνομα χρήστη."
		,de=>"Unbekannter Benutzer"
		,es=>"Nombre De Usuario No Válido"
		,it=>"Utente sconosciuto."
		,pt=>"Usuário desconhecido."
		,ru=>"Неизвестный пользователь."
		,zh=>"未知用户。"
		]);}
	public static function txtMsgInvalidPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid password."
		,fr=>"Mot de passe incorrect."
		,el=>"Λάθος κωδικός πρόσβασης."
		,de=>"Ungültiges Passwort"
		,es=>"Contraseña No Válida"
		,it=>"Password non valida."
		,pt=>"Senha inválida."
		,ru=>"Неправильный пароль."
		,zh=>"无效密码。"
		]);}
	public static function txtMsgInvalidUsernameOrPassword(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid username or password."
		,fr=>"Utilisateur inconnu ou mot de passe incorrect."
		,el=>"Λάθος όνομα χρήστη ή λάθος κωδικός πρόσβασης."
		,de=>"Unbekannter/s Benutzername oder Passwort"
		,es=>"Nombre De Usuario o Contraseña No Válidos"
		,it=>"Username e/o password non validi."
		,pt=>"Nome de usuário ou senha inválidos."
		,ru=>"Неправильный пароль или имя пользователя."
		,zh=>"无效用户名或密码。"
		]);}
	public static function txtMsgMultipleUsersFound(){ return Lemma::txt([__FUNCTION__
		,en=>"Multiple users found."
		,fr=>"Plusieurs utilisateurs trouvés."
		,el=>"Βρέθηκαν πολλαπλοί χρήστες."
		,de=>"Mehrere Benutzer gefunden"
		,es=>"Varios Usuarios Encontrados"
		,it=>"Sono stati trovati più utenti"
		,pt=>"Vários usuários encontrados."
		,ru=>"Найдено несколько пользователей."
		,zh=>"找到多名用户。"
		]);}
	public static function txtMsgEmailSentSuccessfully(){ return Lemma::txt([__FUNCTION__
		,en=>"The e-mail has been sent successfully."
		,fr=>"Le message e-mail a été bien envoyé."
		,el=>"Η αποστολή του e-mail έγινε επιτυχώς."
		,de=>"Die E-Mail wurde erfolgreich versandt"
		,es=>"Email Enviado Exitosamente"
		,it=>"La email è stata inviata."
		,pt=>"O e-mail foi enviado com sucesso."
		,ru=>"Электронное письмо было успешно отправлено."
		,zh=>"已成功发送电子邮件。"
		]);}
	public static function txtMsgInvalidEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid e-mail address."
		,fr=>"L'adresse e-mail n'est pas valide."
		,el=>"Λάθος διεύθυνση e-mail."
		,de=>"Ungültige E-Mail-Adresse"
		,es=>"Email No Válido"
		,it=>"Indirizzo email non valido."
		,pt=>"Endereço de e-mail inválido."
		,ru=>"Неправильный адрес электронной почты."
		,zh=>"无效电子邮箱地址。"
		]);}
	public static function txtMsgInvalidPhone(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid phone number. Please use international format (+123456789)."
		,fr=>"Le numéro n'est pas valide. Veuillez utilisez le format international (+123456789)."
		,el=>"Λάθος αριθμός τηλεφώνου. Χρησιμοποιήστε το διεθνές πρότυπο (+123456789)."
		,de=>"Ungültige Telefonnummer. Bitte verwenden Sie das internationale Format (+123456789)."
		,es=>"Teléfono No válido. Por favor, use el formato internacional (+123456789)."
		,it=>"Numero di telefono non valido. Usa il formato internazionale (+123456789)."
		,pt=>"Número de telefone inválido. Por favor, use o formato internacional (123456789)."
		,ru=>"Неправильный номер телефона. Пожалуйста, используйте международный формат (+123456789)."
		,zh=>"无效电话号码。请使用国际格式（+123456789）。"
		]);}
	public static function txtMsgInvalidURL(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid address."
		,fr=>"L'adresse n'est pas valide."
		,el=>"Λάθος διεύθυνση."
		,de=>"Ungültige Adresse"
		,es=>"Dirección No válida."
		,it=>"Indirizzo email non valido."
		,pt=>"Endereço inválido."
		,ru=>"Неправильный адрес."
		,zh=>"无效地址。"
		]);}
	public static function txtMsgInvalidValue(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid value."
		,fr=>"Le valeur n'est pas valide."
		,el=>"Λάθος τιμή."
		,de=>"Ungültiger Wert"
		,es=>"Valor No Válido."
		,it=>"Valore non valido."
		,pt=>"Valor inválido."
		,ru=>"Недопустимое значение."
		,zh=>"无效值。"
		]);}

	public static function txtMsgAccountBanned(){ return Lemma::txt([__FUNCTION__
		,en=>"User account locked."
		,fr=>"Compte utilisateur bloqué."
		,el=>"Kλειδωμένος λογαριασμός χρήστη."
		,de=>"Benutzerkonto gesperrt"
		,es=>"Cuenta de Usuario Baneada."
		,it=>"Conto utente bloccato."
		,pt=>"Conta de usuário bloqueada."
		,ru=>"Аккаунт пользователя заблокирован."
		,zh=>"用户帐户被锁。"
		]);}

	public static function txtMsgPasswordsDoNotMatch(){ return Lemma::txt([__FUNCTION__
		,en=>"The passwords do not match."
		,fr=>"Les deux mots de passe ne sont pas identiques."
		,el=>"Οι κωδικοί δεν είναι ίδιοι."
		,de=>"Die Passwörter stimmen nicht überein"
		,es=>"Las Contraseñas No Coinciden."
		,it=>"Le password non coincidono."
		,pt=>"As senhas não são iguais."
		,ru=>"Пароли не совпадают."
		,zh=>"密码不匹配。"
		]);}

	public static function txtMsgMandatoryFields(){ return Lemma::txt([__FUNCTION__
		,en=>"The fields with * are mandatory."
		,fr=>"Les champs avec * sont obligatoires."
		,el=>"Τα πεδία με * είναι υποχρεωτικά."
		,de=>"Mit * gekennzeichnete Felder sind obligatorisch."
		,es=>"Los Campos con * son Obligatorios."
		,it=>"I campi contrassegnati con * sono obbligatori."
		,pt=>"Os campos com * são obrigatórios."
		,ru=>"Поля, отмеченные звездочкой, обязательны для заполнения."
		,zh=>"带*号的字段为必填。"
		]);}

	public static function txtMsgMandatoryField(){ return Lemma::txt([__FUNCTION__
		,en=>"This field is mandatory."
		,fr=>"Ce champ est obligatoire."
		,el=>"Το πεδίο αυτό είναι υποχρεωτικό."
		,de=>"Dieses Feld ist obligatorisch."
		,es=>"Este Campo es Obligatorio."
		,it=>"Questo campo è obbligatorio."
		,pt=>"Este campo é obrigatório."
		,ru=>"Это поле обязательно для заполнения."
		,zh=>"该字段必填。"
		]);}

	public static function txtMsgFieldMandatoryInAllLanguages(){ return Lemma::txt([__FUNCTION__
		,en=>"This field is mandatory in all languages."
		,fr=>"Ce champ est obligatoire en toutes les langues."
		,el=>"Το πεδίο αυτό είναι υποχρεωτικό σε όλες τις γλώσσες."
		,de=>"Dieses Feld ist in allen Sprachen obligatorisch."
		,es=>"Este Campo es Obligatorio En Todas Las Lenguas."
		,it=>"Questo campo è obbligatorio in tutte le lingue."
		,pt=>"Este campo é obrigatório em todos os idiomas."
		,ru=>"Это поле обязательно на всех языках."
		,zh=>"所有语言的该字段必填。"
		]);}

	public static function txtMsgPasswordChanged(){ return Lemma::txt([__FUNCTION__
		,en=>"The password has been changed."
		,fr=>"Le mot de passe a été changé."
		,el=>"Ο κωδικός πρόσβασης άλλαξε."
		,de=>"Das Passwort wurde geändert."
		,es=>"La Contraseña se ha cambiado."
		,it=>"La password è stata cambiata."
		,pt=>"A senha foi alterada."
		,ru=>"Пароль был изменен."
		,zh=>"密码已更改。"
		]);}

	public static function txtMsgProfileChanged(){ return Lemma::txt([__FUNCTION__
		,en=>"The user profile has been changed."
		,fr=>"Le profil de l'utilisateur a été changé."
		,el=>"Το προφίλ χρήστη άλλαξε."
		,de=>"Das Benutzerprofil wurde geändert."
		,es=>"El perfil de usuario se ha cambiado."
		,it=>"Il profilo dell'utente è stato cambiato."
		,pt=>"O perfil do usuário foi alterado."
		,ru=>"Профиль пользователя был изменен."
		,zh=>"用户个人资料已被更改。"
		]);}

	public static function txtMsgUsernameExists(){ return Lemma::txt([__FUNCTION__
		,en=>"This username already exists."
		,fr=>"Cet utilisateur existe déjà."
		,el=>"Αυτό το όνομα χρήστη υπάρχει ήδη."
		,de=>"Diesen Benutzernamen gibt es bereits."
		,es=>"Este nombre de usuario ya existe."
		,it=>"Questo username esiste già."
		,pt=>"Este nome de usuário já existe."
		,ru=>"Это имя пользователя уже существует."
		,zh=>"该用户名已经存在。"
		]);}

	public static function txtMsgCannotSendEmail(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while sending e-mail."
		,fr=>"Erreur lors de l'envoi d'e-mail."
		,el=>"Σφάλμα κατά την αποστολή e-mail."
		,de=>"Fehler beim Senden der E-Mail."
		,es=>"Error al enviar el email."
		,it=>"Errore durante l'invio della email."
		,pt=>"Erro ao enviar e-mail."
		,ru=>"Ошибка при отправке электронной почты."
		,zh=>"发送电子邮件时出错。"
		]);}

	public static function txtMsgCannotConnectToDatabase(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while connecting to the database."
		,fr=>"Erreur lors de la connexion à la base de données."
		,el=>"Σφάλμα κατά την σύνδεση με τη βάση δεδομένων."
		,de=>"Fehler beim Verbinden mit der Datenbank"
		,es=>"Error al conectar a la base de datos."
		,it=>"Errore durante la connessione con il database."
		,pt=>"Erro ao se conectar com o banco de dados."
		,ru=>"Ошибка при подключении к базе данных."
		,zh=>"连接至服务器时出错。"
		]);}
	public static function txtMsgCannotCreateDatabase(){ return Lemma::txt([__FUNCTION__
		,en=>"Error while creating database schema."
		,fr=>"Erreur lors de la création de la base de données."
		,el=>"Σφάλμα κατά την δημιουργία νέας βάσης δεδομένων."
		,de=>"Fehler beim Erstellen des Datenbankschemas."
		,es=>"Error al crear la base de datos."
		,it=>"Errore durante la creazione dello schema del database."
		,pt=>"Erro ao criar o esquema do banco de dados."
		,ru=>"Ошибка при создании схемы базы данных."
		,zh=>"创建数据库架构时出错。"
		]);}

	public static function txtMsgCannotDeleteCurrentUser(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot delete current user."
		,fr=>"Il est impossible de supprimer l'utilisateur courant."
		,el=>"Δεν είναι δυνατό να διαγραφεί ο τρέχον χρήστης."
		,de=>"Der aktuelle Benutzer kann nicht gelöscht werden."
		,es=>"No Se Puede Eliminar Al Usuario Actual"
		,it=>"Impossibile eliminare l'utente attuale."
		,pt=>"Não é possível excluir o usuário atual."
		,ru=>"Невозможно удалить текущего пользователя."
		,zh=>"无法删除当前用户。"
		]);}

	public static function txtMsgObjectXNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"This object was not found: %s."
		,fr=>"Objet non trouvé : %s."
		,el=>"Το αντικείμενο αυτό δεν βρέθηκε: [%s]."
		,de=>"Dieses Objekt wurde nicht gefunden: %s"
		,es=>"El Objeto %s No Se Encontró"
		,it=>"Questo oggetto non è stato trovato: %s."
		,pt=>"Este objeto não foi encontrado: %s."
		,ru=>"Этот объект не найден: %s."
		,zh=>"未找到该对象：%s。"
		]);}
	public static function txtMsgObjectXAlreadyExists(){ return Lemma::txt([__FUNCTION__
		,en=>"This object already exists: %s."
		,fr=>"Cet objet existe déjà : %s."
		,el=>"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		,de=>"Dieses Objekt gibt es bereits: %s"
		,es=>"Este objeto ya existe: %s."
		,it=>"Questo oggetto esiste già: %s."
		,pt=>"Este objeto já existe: %s."
		,ru=>"Этот объект уже существует: %s."
		,zh=>"已经存在该对象：%s。"
		]);}
	public static function txtMsgCannotDeleteSystemObject(){ return Lemma::txt([__FUNCTION__
		,en=>"This object is used by the system."
		,fr=>"Cet objet est utilisé par le système."
		,el=>"Το αντικείμενο είναι απαραίτητο για την ομαλή λειτουργεία του συστήματος."
		,de=>"Dieses Objekt wird vom System verwendet."
		,es=>"El objeto está siendo usado por el sistema."
		,it=>"Questo oggetto viene usato dal sistema."
		,pt=>"Este objeto é utilizado pelo sistema."
		,ru=>"Этот объект используется системой."
		,zh=>"该对象已被系统使用。"
		]);}


	public static function txtMsgXItemNotFound(){ return Lemma::txt([__FUNCTION__
		,en=>"This object was not found [%s %s]."
		,fr=>"Objet non trouvé [%s %s]."
		,el=>"Το αντικείμενο αυτό δεν βρέθηκε: [%s %s]."
		,de=>"Dieses Objekt wurde nicht gefunden [%s %s]."
		,es=>"Este objeto no se encontró [%s %s]"
		,it=>"Questo oggetto non è stato trovato [%s %s]."
		,pt=>"Este objeto não foi encontrado [%s %s]."
		,ru=>"Этот объект не найден [%s %s]."
		,zh=>"未找到该对象 [%s %s]。"
		]);}
	public static function txtMsgXItemAlreadyExists(){ return Lemma::txt([__FUNCTION__
		,fr=>"Cet objet existe déjà: %s."
		,en=>"This object already exists: %s."
		,el=>"Το αντικείμενο αυτό υπάρχει ήδη: %s."
		,de=>"Dieses Objekt existiert bereits."
		,es=>"Este objeto ya existe: %s."
		,it=>"Questo oggetto esiste già: %s."
		,pt=>"Este objeto já existe: %s."
		,ru=>"Этот объект уже существует: %s."
		,zh=>"已经存在该对象：%s。"
		]);}

	public static function txtMsgCancelling(){ return Lemma::txt([__FUNCTION__
		,en=>"Cancelling..."
		,fr=>"Annulation..."
		,el=>"Ακύρωση..."
		,de=>"Wird abgebrochen ..."
		,es=>"Cancelando..."
		,it=>"Annullamento in corso..."
		,pt=>"Cancelando..."
		,ru=>"Отмена..."
		,zh=>"取消中..."
		]);}
	public static function txtMsgProgressCancelled(){ return Lemma::txt([__FUNCTION__
		,en=>"The process has been cancelled."
		,fr=>"Le processus a été annulé."
		,el=>"Η διαδικασία ακυρώθηκε."
		,de=>"Der Vorgang wurde abgebrochen."
		,es=>"El proceso se ha cancelado."
		,it=>"Il processo è stato annullato."
		,pt=>"O processo foi cancelado."
		,ru=>"Процесс был отменен."
		,zh=>"该流程已被取消。"
		]);}
	public static function txtMsgProgressCompleted(){ return Lemma::txt([__FUNCTION__
		,en=>"The process is completed."
		,fr=>"Le processus est terminé."
		,el=>"Η διαδικασία ολοκληρώθηκε."
		,de=>"Der Vorgang ist abgeschlossen."
		,es=>"El proceso se ha completado."
		,it=>"Il processo è completato."
		,pt=>"O processo está concluído."
		,ru=>"Процесс завершен."
		,zh=>"该流程已完成。"
		]);}
	public static function txtMsgNoObjectFound(){ return Lemma::txt([__FUNCTION__
		,en=>"No object found."
		,fr=>"Pas d'objet trouvé."
		,el=>"Δε βρέθηκε κανένα αντικείμενο."
		,de=>"Kein Objekt gefunden"
		,es=>"No se ha encontrado ningún objeto."
		,it=>"Nessun oggetto trovato."
		,pt=>"Nenhum objeto encontrado."
		,ru=>"Объект не найден."
		,zh=>"未找到对象。"
		]);}
	public static function txtMsgInvalidAction(){ return Lemma::txt([__FUNCTION__
		,en=>"Invalid action."
		,fr=>"Action invalide."
		,el=>"Εσφαλμένη εντολή."
		,de=>"Ungültige Aktion"
		,es=>"Acción no válida."
		,it=>"Azione non valida."
		,pt=>"Ação inválida."
		,ru=>"Недопустимое действие."
		,zh=>"无效动作。"
		]);}

	public static function txtMsgCannotConnectToLdapServer(){ return Lemma::txt([__FUNCTION__
		,en=>"Cannot connect to the database."
		,fr=>"Erreur à la connexion à la base de données."
		,el=>"Σφάλμα σύνδεσης με την βάση δεδομένων."
		,de=>"Es kann keine Verbindung zur Datenbank hergestellt werden."
		,es=>"No se puede conectar a la base de datos."
		,it=>"Impossibile connettersi al database."
		,pt=>"Não é possível conectar-se ao banco de dados."
		,ru=>"Не удается подключиться к базе данных."
		,zh=>"无法连接至数据库。"
		]);}


	public static function txtMsgDevelopmentEnvironment(){ return Lemma::txt([__FUNCTION__
		,en=>"You are viewing this message because the application runs in DEVELOPMENT mode."
		,fr=>"Ce message s'affiche parce que l'application est en mode DEVELOPPEMENT."
		,el=>"Το μήνυμα αυτό εμφανίζεται γιατί η εφαρμογή τρέχει σε περιβάλλον ανάπτυξης."
		,de=>"Diese Meldung wird angezeigt, weil die Applikation im ENTWICKLUNGSMODUS läuft."
		,es=>"Está viendo este mensaje porque la aplicación se está ejecutando en modo DESARROLLO."
		,it=>"Stai visualizzando questo messaggio perché l'applicazione viene eseguita in modalità SVILUPPO."
		,pt=>"Você está vendo esta mensagem porque o aplicativo é executado no modo de desenvolvimento."
		,ru=>"Вы видите это сообщение, так как приложение запущено в режиме РАЗРАБОТКИ."
		,zh=>"您在查看该信息是因为该应用是以开发模式运行的。"
		]);}
	public static function txtMsgAnErrorOccurred(){ return Lemma::txt([__FUNCTION__
		,en=>"An unexpected server error has occurred."
		,fr=>"Il y avait une erreur inattendue."
		,el=>"Προέκυψε ένα σφάλμα στον διακομιστή."
		,de=>"Ein unerwarteter Serverfehler ist aufgetreten."
		,es=>"Ha habido un error inesperado en el servidor."
		,it=>"Si è verificato un errore imprevisto del server."
		,pt=>"Ocorreu um erro inesperado do servidor."
		,ru=>"Произошла непредвиденная ошибка сервера."
		,zh=>"出现了一个意外服务器错误。"
		]);}
	public static function txtMsgAnErrorOccurredAndTeamNotified(){ return Lemma::txt([__FUNCTION__
		,en=>"An unexpected server error has occurred. The support team has been notified."
		,fr=>"Il y avait une erreur inattendue. L'équipe de support vient d'en être notifié."
		,el=>"Προέκυψε ένα σφάλμα στον διακομιστή. Η ομάδα υποστήριξης ειδοποιήθηκε."
		,de=>"Ein unerwarteter Serverfehler ist aufgetreten und das Support-Team wurde benachrichtigt."
		,es=>"Ha habido un error inesperado en el servido. El equipo de ayuda ha sido avisado."
		,it=>"Si è verificato un errore imprevisto del server. Il team dedicato al supporto è stato avvisato."
		,pt=>"Ocorreu um erro inesperado do servidor. A equipe de suporte foi notificada."
		,ru=>"Произошла непредвиденная ошибка сервера. Служба поддержки была уведомлена."
		,zh=>"出现了意外服务器错误。已通知了支持团队。"
		]);}


	public static function txtMsgErrorWhileUploadingFile(){ return Lemma::txt([__FUNCTION__
		,en=>"An error occurred while uploading file."
		,fr=>"Erreur pendant l'envoi du fichier."
		,el=>"Σφάλμα κατά την αποστολή του αρχείου."
		,de=>"Beim Hochladen der Datei ist ein Fehler aufgetreten."
		,es=>"Error al cargar el archivo."
		,it=>"Si è verificato un errore durante il caricamento del file."
		,pt=>"Ocorreu um erro ao fazer o upload de arquivo."
		,ru=>"Произошла ошибка при отправке файла."
		,zh=>"上传文件时出现了错误。"
		]);}

	public static function txtMsgErrorWhileDownloadingFile(){ return Lemma::txt([__FUNCTION__
		,en=>"An error occurred while downloading file."
		,fr=>"Erreur pendant le téléchargement du fichier."
		,el=>"Σφάλμα κατά την λήψη του αρχείου."
		,de=>"Beim Herunterladen der Datei ist ein Fehler aufgetreten"
		,es=>"Error al descargar el archivo."
		,it=>"Si è verificato un errore durante lo scaricamento del file."
		,pt=>"Ocorreu um erro durante o download do arquivo."
		,ru=>"Произошла ошибка при загрузке файла."
		,zh=>"下载文件时出现了错误。"
		]);}
	public static function txtMsgUnsavedChanges(){ return Lemma::txt([__FUNCTION__
		,en=>"There are unsaved changes."
		,fr=>"Il y a des changements qui ne sont pas sauvegardés."
		,el=>"Υπάρχουν μη αποθηκευμένες αλλαγές."
		,de=>"Es gibt ungespeicherte Änderungen"
		,es=>"Hay cambios no guardados."
		,it=>"Ci sono delle modifiche non salvate."
		,pt=>"Há alterações não salvas."
		,ru=>"Есть несохраненные данные."
		,zh=>"有未保存的更改。"
		]);}



	public static function txtUnit_byte(){ return Lemma::txt([__FUNCTION__
		,en=>"B"
		,fr=>"o"
		,el=>"B"
		,de=>"B"
		,es=>"B"
		,it=>"B"
		,pt=>"B"
		,ru=>"Б"
		,zh=>"字节"
		]);}
	public static function txtUnit_sec(){ return Lemma::txt([__FUNCTION__
		,en=>"sec"
		,fr=>"sec"
		,el=>"sec"
		,de=>"sec"
		,es=>"seg"
		,it=>"sec."
		,pt=>"seg"
		,ru=>"сек"
		,zh=>"秒"
		]);}
	public static function txtUnit_day(){ return Lemma::txt([__FUNCTION__
		,en=>"d"
		,fr=>"j"
		,el=>"ημ"
		,de=>"t"
		,es=>"d"
		,it=>"g."
		,pt=>"d"
		,ru=>"д"
		,zh=>"天"
		]);}
	public static function txtUnit_hour(){ return Lemma::txt([__FUNCTION__
		,en=>"h"
		,fr=>"h"
		,el=>"ώρ"
		,de=>"h"
		,es=>"h"
		,it=>"h"
		,pt=>"h"
		,ru=>"ч"
		,zh=>"小时"
		]);}


	public static function txtLang_($x){ return static::txt(__FUNCTION__,$x); }
	public static function txtLang_en(){ return Lemma::txt([__FUNCTION__
		,en=>"English"
		,fr=>"Anglais"
		,el=>"Αγγλικά"
		,de=>"Englisch"
		,es=>"Inglés"
		,it=>"Inglese"
		,pt=>"Inglês"
		,ru=>"Английский"
		,zh=>"英语"
		]);}
	public static function txtLang_fr(){ return Lemma::txt([__FUNCTION__
		,en=>"French"
		,fr=>"Français"
		,el=>"Γαλλικά"
		,de=>"Französisch"
		,es=>"Francés"
		,it=>"Francese"
		,pt=>"Francês"
		,ru=>"Французский"
		,zh=>"法语"
		]);}
	public static function txtLang_el(){ return Lemma::txt([__FUNCTION__
		,en=>"Greek"
		,fr=>"Grec"
		,el=>"Ελληνικά"
		,de=>"Griechisch"
		,es=>"Griego"
		,it=>"Greco"
		,pt=>"Grego"
		,ru=>"Греческий "
		,zh=>"希腊语"
		]);}
	public static function txtLang_ar(){ return Lemma::txt([__FUNCTION__
		,en=>"Arabic"
		,fr=>"Arabic"
		,de=>"Arabisch"
		,es=>"Árabe"
		,it=>"Arabo"
		,pt=>"Árabe"
		,ru=>"Арабский"
		,zh=>"阿拉伯语"
		]);}
	public static function txtLang_de(){ return Lemma::txt([__FUNCTION__
		,en=>"German"
		,fr=>"Allemand"
		,de=>"Deutsch"
		,es=>"Alemán"
		,it=>"Tedesco"
		,pt=>"Alemão"
		,ru=>"Немецкий"
		,zh=>"德语"
		]);}
	public static function txtLang_es(){ return Lemma::txt([__FUNCTION__
		,en=>"Spanish"
		,fr=>"Espagnol"
		,de=>"Spanisch"
		,es=>"Español"
		,it=>"Spagnolo"
		,pt=>"Espanhol"
		,ru=>"Испанский"
		,zh=>"西班牙语"
		]);}
	public static function txtLang_it(){ return Lemma::txt([__FUNCTION__
		,en=>"Italian"
		,fr=>"Italien"
		,de=>"Italienisch"
		,es=>"Italiano"
		,it=>"Italiano"
		,pt=>"Italiano"
		,ru=>"Итальянский"
		,zh=>"意大利语"
		]);}
	public static function txtLang_fi(){ return Lemma::txt([__FUNCTION__
		,en=>"Finnish"
		,fr=>"Finnois"
		,de=>"Finnisch"
		,es=>"Finlandés"
		,it=>"Finlandese"
		,pt=>"Finlandês"
		,ru=>"Финский"
		,zh=>"芬兰语"
		]);}
	public static function txtLang_ja(){ return Lemma::txt([__FUNCTION__
		,en=>"Japanese"
		,fr=>"Japonais"
		,de=>"Japanisch"
		,es=>"Japonés"
		,it=>"Giapponese"
		,pt=>"Japonês"
		,ru=>"Японский"
		,zh=>"日语"
		]);}
	public static function txtLang_ko(){ return Lemma::txt([__FUNCTION__
		,en=>"Korean"
		,fr=>"Coréen"
		,de=>"Koreanisch"
		,es=>"Coreano"
		,it=>"Coreano"
		,pt=>"Coreano"
		,ru=>"Корейский"
		,zh=>"韩语"
		]);}
	public static function txtLang_nl(){ return Lemma::txt([__FUNCTION__
		,en=>"Dutch"
		,fr=>"Néerlandais"
		,de=>"Niederländisch"
		,es=>"Holandés"
		,it=>"Olandese"
		,pt=>"Holandês"
		,ru=>"Нидерландский "
		,zh=>"荷兰语"
		]);}
	public static function txtLang_no(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian"
		,fr=>"Norvégien"
		,de=>"Norwegisch"
		,es=>"Noruego"
		,it=>"Norvegese"
		,pt=>"Norueguês"
		,ru=>"Норвежский"
		,zh=>"挪威语"
		]);}
	public static function txtLang_pl(){ return Lemma::txt([__FUNCTION__
		,en=>"Polish"
		,fr=>"Polonais"
		,de=>"Polnisch"
		,es=>"Polaco"
		,it=>"Polacco"
		,pt=>"Polonês"
		,ru=>"Польский"
		,zh=>"波兰语"
		]);}
	public static function txtLang_pt(){ return Lemma::txt([__FUNCTION__
		,en=>"Portuguese"
		,fr=>"Portugais"
		,de=>"Portugiesisch"
		,es=>"Portugués"
		,it=>"Portoghese"
		,pt=>"Português"
		,ru=>"Португальский"
		,zh=>"葡萄牙语"
		]);}
	public static function txtLang_ru(){ return Lemma::txt([__FUNCTION__
		,en=>"Russian"
		,fr=>"Russe"
		,de=>"Russisch"
		,es=>"Ruso"
		,it=>"Russo"
		,pt=>"Russo"
		,ru=>"Русский"
		,zh=>"俄语"
		]);}
	public static function txtLang_sv(){ return Lemma::txt([__FUNCTION__
		,en=>"Swedish"
		,fr=>"Suédois"
		,de=>"Schwedisch"
		,es=>"Sueco"
		,it=>"Svedese"
		,pt=>"Sueco"
		,ru=>"Шведский"
		,zh=>"瑞典语"
		]);}
	public static function txtLang_zh(){ return Lemma::txt([__FUNCTION__
		,en=>"Chinese"
		,fr=>"Chinois"
		,de=>"Chinesisch"
		,es=>"Chino"
		,it=>"Cinese"
		,pt=>"Chinês"
		,ru=>"Китайский"
		,zh=>"汉语"
		]);}

	public static function txtLang_ab(){ return Lemma::txt([__FUNCTION__
		,en=>"Abkhaz"
		,de=>"Abchasisch"
		,es=>"Abkhaz"
		,it=>"Abcaso"
		,pt=>"Abecásio"
		,ru=>"Абхазский"
		,zh=>"阿布哈兹语"
		]);}
	public static function txtLang_aa(){ return Lemma::txt([__FUNCTION__
		,en=>"Afar"
		,de=>"Afar"
		,es=>"Afar"
		,it=>"Afar"
		,pt=>"Afar"
		,ru=>"Афарский "
		,zh=>"阿法尔语"
		]);}
	public static function txtLang_af(){ return Lemma::txt([__FUNCTION__
		,en=>"Afrikaans"
		,de=>"Afrikaans"
		,es=>"Afrikáans"
		,it=>"Afrikaans"
		,pt=>"Africâner"
		,ru=>"Африкаанс"
		,zh=>"南非荷兰语"
		]);}
	public static function txtLang_ak(){ return Lemma::txt([__FUNCTION__
		,en=>"Akan"
		,de=>"Akan"
		,es=>"Akan"
		,it=>"Akan"
		,pt=>"Akan"
		,ru=>"Акан "
		,zh=>"阿肯语"
		]);}
	public static function txtLang_sq(){ return Lemma::txt([__FUNCTION__
		,en=>"Albanian"
		,de=>"Albanisch"
		,es=>"Albanés"
		,it=>"Albanese"
		,pt=>"Albanês"
		,ru=>"Албанский"
		,zh=>"阿尔巴尼亚语"
		]);}
	public static function txtLang_am(){ return Lemma::txt([__FUNCTION__
		,en=>"Amharic"
		,de=>"Amharisch"
		,es=>"Amhárico"
		,it=>"Amarico"
		,pt=>"Amárico"
		,ru=>"Амхарский"
		,zh=>"阿姆哈拉语"
		]);}
	public static function txtLang_an(){ return Lemma::txt([__FUNCTION__
		,en=>"Aragonese"
		,de=>"Aragonisch"
		,es=>"Aragonés"
		,it=>"Aragonese"
		,pt=>"Aragonês"
		,ru=>"Арагонский"
		,zh=>"阿拉贡语"
		]);}
	public static function txtLang_hy(){ return Lemma::txt([__FUNCTION__
		,en=>"Armenian"
		,de=>"Armenisch"
		,es=>"Armenio"
		,it=>"Armeno"
		,pt=>"Armênio"
		,ru=>"Армянский"
		,zh=>"亚美尼亚语"
		]);}
	public static function txtLang_as(){ return Lemma::txt([__FUNCTION__
		,en=>"Assamese"
		,de=>"Assamesisch"
		,es=>"Asamés"
		,it=>"Assamese"
		,pt=>"Assamês "
		,ru=>"Ассамский"
		,zh=>"阿萨姆语"
		]);}
	public static function txtLang_av(){ return Lemma::txt([__FUNCTION__
		,en=>"Avaric"
		,de=>"Awarisch"
		,es=>"Ávaro"
		,it=>"Avaro"
		,pt=>"Avárico"
		,ru=>"Аварский "
		,zh=>"阿瓦尔语"
		]);}
	public static function txtLang_ae(){ return Lemma::txt([__FUNCTION__
		,en=>"Avestan"
		,de=>"Avestan"
		,es=>"Avéstico"
		,it=>"Avestico"
		,pt=>"Avéstico"
		,ru=>"Авестийский"
		,zh=>"阿维斯陀语"
		]);}
	public static function txtLang_ay(){ return Lemma::txt([__FUNCTION__
		,en=>"Aymara"
		,de=>"Aymara"
		,es=>"Aymara"
		,it=>"Aymara"
		,pt=>"Aimará"
		,ru=>"Аймара "
		,zh=>"艾马拉语"
		]);}
	public static function txtLang_az(){ return Lemma::txt([__FUNCTION__
		,en=>"Azerbaijani"
		,de=>"Aserbaidschanisch"
		,es=>"Azerí"
		,it=>"Azero"
		,pt=>"Azerbaijano (Azeri)"
		,ru=>"Азербайджанский"
		,zh=>"阿塞拜疆语"
		]);}
	public static function txtLang_bm(){ return Lemma::txt([__FUNCTION__
		,en=>"Bambara"
		,de=>"Bambara"
		,es=>"Bambara"
		,it=>"Bambara"
		,pt=>"Bambara"
		,ru=>"Бамана"
		,zh=>"班巴拉语"
		]);}
	public static function txtLang_ba(){ return Lemma::txt([__FUNCTION__
		,en=>"Bashkir"
		,de=>"Baschkirisch"
		,es=>"Baskir"
		,it=>"Bashkir"
		,pt=>"Bashkir"
		,ru=>"Башкирский"
		,zh=>"巴什基尔语"
		]);}
	public static function txtLang_eu(){ return Lemma::txt([__FUNCTION__
		,en=>"Basque"
		,de=>"Baskisch"
		,es=>"Vasco"
		,it=>"Basco"
		,pt=>"Basco"
		,ru=>"Баскский"
		,zh=>"巴斯克语"
		]);}
	public static function txtLang_be(){ return Lemma::txt([__FUNCTION__
		,en=>"Belarusian"
		,de=>"Belorussisch "
		,es=>"Bielorruso"
		,it=>"Bielorusso"
		,pt=>"Bielorrusso"
		,ru=>"Белорусский"
		,zh=>"白俄罗斯语"
		]);}
	public static function txtLang_bn(){ return Lemma::txt([__FUNCTION__
		,en=>"Bengali"
		,de=>"Bengalisch"
		,es=>"Bengalí"
		,it=>"Bengalese"
		,pt=>"Bengalês"
		,ru=>"Бенгальский"
		,zh=>"孟加拉语"
		]);}
	public static function txtLang_bh(){ return Lemma::txt([__FUNCTION__
		,en=>"Bihari"
		,de=>"Biharisch"
		,es=>"Bihari"
		,it=>"Bihari"
		,pt=>"Biari"
		,ru=>"Бихарский"
		,zh=>"比哈尔语"
		]);}
	public static function txtLang_bi(){ return Lemma::txt([__FUNCTION__
		,en=>"Bislama"
		,de=>"Bislama"
		,es=>"Bislama"
		,it=>"Bislama"
		,pt=>"Bislama"
		,ru=>"Бислама"
		,zh=>"比斯拉马语"
		]);}
	public static function txtLang_bs(){ return Lemma::txt([__FUNCTION__
		,en=>"Bosnian"
		,de=>"Bosnisch"
		,es=>"Bosnio"
		,it=>"Bosniaco"
		,pt=>"Bósnia"
		,ru=>"Боснийский"
		,zh=>"波斯尼亚语"
		]);}
	public static function txtLang_br(){ return Lemma::txt([__FUNCTION__
		,en=>"Breton"
		,de=>"Brettonisch"
		,es=>"Bretón"
		,it=>"Bretone"
		,pt=>"Bretão"
		,ru=>"Бретонский"
		,zh=>"布列塔尼语"
		]);}
	public static function txtLang_bg(){ return Lemma::txt([__FUNCTION__
		,en=>"Bulgarian"
		,de=>"Bulgarisch"
		,es=>"Búlgaro"
		,it=>"Bulgaro"
		,pt=>"Búlgaro"
		,ru=>"Болгарский"
		,zh=>"保加利亚语"
		]);}
	public static function txtLang_my(){ return Lemma::txt([__FUNCTION__
		,en=>"Burmese"
		,de=>"Burmesisch"
		,es=>"Birmano"
		,it=>"Birmano"
		,pt=>"Birmanês"
		,ru=>"Бирманский"
		,zh=>"缅甸语"
		]);}
	public static function txtLang_ca(){ return Lemma::txt([__FUNCTION__
		,en=>"Catalan"
		,de=>"Katalanisch"
		,es=>"Catalán"
		,it=>"Catalano"
		,pt=>"Catalão"
		,ru=>"Каталонский"
		,zh=>"加泰罗尼亚语"
		]);}
	public static function txtLang_ch(){ return Lemma::txt([__FUNCTION__
		,en=>"Chamorro"
		,de=>"Chamorro"
		,es=>"Chamorro"
		,it=>"Chamorro"
		,pt=>"Chamorro"
		,ru=>"Чаморро"
		,zh=>"查莫罗语"
		]);}
	public static function txtLang_ce(){ return Lemma::txt([__FUNCTION__
		,en=>"Chechen"
		,de=>"Tschetschenisch"
		,es=>"Chechén"
		,it=>"Ceceno"
		,pt=>"Checheno"
		,ru=>"Чеченский"
		,zh=>"车臣语"
		]);}
	public static function txtLang_ny(){ return Lemma::txt([__FUNCTION__
		,en=>"Chichewa"
		,de=>"Chichewa"
		,es=>"Chichewa"
		,it=>"Chewa"
		,pt=>"Cinianja"
		,ru=>"Чичева"
		,zh=>"齐佩瓦语"
		]);}
	public static function txtLang_cv(){ return Lemma::txt([__FUNCTION__
		,en=>"Chuvash"
		,de=>"Chuvash"
		,es=>"Chuvash"
		,it=>"Ciuvascio"
		,pt=>"Tchuvache"
		,ru=>"Чувашский"
		,zh=>"楚瓦什语"
		]);}
	public static function txtLang_kw(){ return Lemma::txt([__FUNCTION__
		,en=>"Cornish"
		,de=>"Kornisch"
		,es=>"Córnico"
		,it=>"Cornico"
		,pt=>"Tchetcheno"
		,ru=>"Корнский "
		,zh=>"康沃尔语"
		]);}
	public static function txtLang_co(){ return Lemma::txt([__FUNCTION__
		,en=>"Corsican"
		,de=>"Korsisch"
		,es=>"Corso"
		,it=>"Corso"
		,pt=>"Corso"
		,ru=>"Корсиканский  "
		,zh=>"科西嘉语"
		]);}
	public static function txtLang_cr(){ return Lemma::txt([__FUNCTION__
		,en=>"Cree"
		,de=>"Cree"
		,es=>"Cree"
		,it=>"Cree"
		,pt=>"Cree"
		,ru=>"Кри"
		,zh=>"克里语"
		]);}
	public static function txtLang_hr(){ return Lemma::txt([__FUNCTION__
		,en=>"Croatian"
		,de=>"Kroatisch"
		,es=>"Croata"
		,it=>"Croato"
		,pt=>"Croata"
		,ru=>"Хорватский"
		,zh=>"克罗地亚语"
		]);}
	public static function txtLang_cs(){ return Lemma::txt([__FUNCTION__
		,en=>"Czech"
		,de=>"Tschechisch"
		,es=>"Checo"
		,it=>"Ceco"
		,pt=>"Tcheco"
		,ru=>"Чешский"
		,zh=>"捷克语"
		]);}
	public static function txtLang_da(){ return Lemma::txt([__FUNCTION__
		,en=>"Danish"
		,de=>"Dänisch"
		,es=>"Danés"
		,it=>"Danese"
		,pt=>"Dinamarquês"
		,ru=>"Датский"
		,zh=>"丹麦语"
		]);}
	public static function txtLang_dv(){ return Lemma::txt([__FUNCTION__
		,en=>"Divehi"
		,de=>"Divehi"
		,es=>"Dhivehi"
		,it=>"Divehi"
		,pt=>"Maldívio (Divehi)"
		,ru=>"Дивехи "
		,zh=>"迪维西语"
		]);}
	public static function txtLang_dz(){ return Lemma::txt([__FUNCTION__
		,en=>"Dzongkha"
		,de=>"Dzongkha"
		,es=>"Dzongkha"
		,it=>"Dzongkha"
		,pt=>"Butanês (Dzonga)"
		,ru=>"Дзонг-кэ"
		,zh=>"宗喀语"
		]);}
	public static function txtLang_eo(){ return Lemma::txt([__FUNCTION__
		,en=>"Esperanto"
		,de=>"Esperanto"
		,es=>"Esperanto"
		,it=>"Esperanto"
		,pt=>"Esperanto"
		,ru=>"Эсперанто"
		,zh=>"世界语"
		]);}
	public static function txtLang_et(){ return Lemma::txt([__FUNCTION__
		,en=>"Estonian"
		,de=>"Estonisch"
		,es=>"Estonio"
		,it=>"Estone"
		,pt=>"Estoniano"
		,ru=>"Эстонский"
		,zh=>"爱沙尼亚语"
		]);}
	public static function txtLang_ee(){ return Lemma::txt([__FUNCTION__
		,en=>"Ewe"
		,de=>"Ewe"
		,es=>"Ewe"
		,it=>"Ewe"
		,pt=>"Ewe"
		,ru=>"Эве"
		,zh=>"埃维语"
		]);}
	public static function txtLang_fo(){ return Lemma::txt([__FUNCTION__
		,en=>"Faroese"
		,de=>"Färöisch "
		,es=>"Faroese"
		,it=>"Faroese"
		,pt=>"Feroês"
		,ru=>"Фарерский"
		,zh=>"法罗语"
		]);}
	public static function txtLang_fj(){ return Lemma::txt([__FUNCTION__
		,en=>"Fijian"
		,de=>"Fidschianisch"
		,es=>"Fiyi"
		,it=>"Figiano"
		,pt=>"Fijiano"
		,ru=>"Фиджийский"
		,zh=>"斐济语"
		]);}
	public static function txtLang_ff(){ return Lemma::txt([__FUNCTION__
		,en=>"Fula"
		,de=>"Fula"
		,es=>"Fula"
		,it=>"Fula"
		,pt=>"Fula"
		,ru=>"Фула"
		,zh=>"富拉语"
		]);}
	public static function txtLang_gl(){ return Lemma::txt([__FUNCTION__
		,en=>"Galician"
		,de=>"Galizisch"
		,es=>"Gallego"
		,it=>"Galiziano"
		,pt=>"Galego"
		,ru=>"Галисийский"
		,zh=>"加利西亚语"
		]);}
	public static function txtLang_ka(){ return Lemma::txt([__FUNCTION__
		,en=>"Georgian"
		,de=>"Georgisch"
		,es=>"Georgiano"
		,it=>"Georgiano"
		,pt=>"Georgiano"
		,ru=>"Грузинский"
		,zh=>"格鲁吉亚语"
		]);}
	public static function txtLang_gn(){ return Lemma::txt([__FUNCTION__
		,en=>"Guaraní"
		,de=>"Guarani"
		,es=>"Guaraní"
		,it=>"Guarani"
		,pt=>"Guarani"
		,ru=>"Гуарани"
		,zh=>"瓜拉尼语"
		]);}
	public static function txtLang_gu(){ return Lemma::txt([__FUNCTION__
		,en=>"Gujarati"
		,de=>"Gujarati"
		,es=>"Gujarati"
		,it=>"Gujarati"
		,pt=>"Gujarate"
		,ru=>"Гуджарати"
		,zh=>"古吉拉特语"
		]);}
	public static function txtLang_ht(){ return Lemma::txt([__FUNCTION__
		,en=>"Haitian"
		,de=>"Haitianisch"
		,es=>"Haitiano"
		,it=>"Haitiano"
		,pt=>"Haitiano"
		,ru=>"Гаитянский"
		,zh=>"海地语"
		]);}
	public static function txtLang_ha(){ return Lemma::txt([__FUNCTION__
		,en=>"Hausa"
		,de=>"Hausa"
		,es=>"Hausa"
		,it=>"Hausa"
		,pt=>"Hauçá"
		,ru=>"Хауса"
		,zh=>"豪萨语"
		]);}
	public static function txtLang_he(){ return Lemma::txt([__FUNCTION__
		,en=>"Hebrew"
		,de=>"Hebräisch"
		,es=>"Hebreo"
		,it=>"Ebraico"
		,pt=>"Hebraico"
		,ru=>"Иврит"
		,zh=>"希伯来语"
		]);}
	public static function txtLang_hz(){ return Lemma::txt([__FUNCTION__
		,en=>"Herero"
		,de=>"Herero"
		,es=>"Herero"
		,it=>"Herero"
		,pt=>"Hereró"
		,ru=>"Гереро"
		,zh=>"赫雷罗语"
		]);}
	public static function txtLang_hi(){ return Lemma::txt([__FUNCTION__
		,en=>"Hindi"
		,de=>"Hindi"
		,es=>"Hindi"
		,it=>"Hindi"
		,pt=>"Hindi"
		,ru=>"Хинди"
		,zh=>"印地语"
		]);}
	public static function txtLang_ho(){ return Lemma::txt([__FUNCTION__
		,en=>"Hiri Motu"
		,de=>"Hiri Moru"
		,es=>"Hiri Motu"
		,it=>"Hiri Motu"
		,pt=>"Hiri motu"
		,ru=>"Хири-моту"
		,zh=>"莫土语"
		]);}
	public static function txtLang_hu(){ return Lemma::txt([__FUNCTION__
		,en=>"Hungarian"
		,de=>"Ungarisch"
		,es=>"Húngaro"
		,it=>"Ungherese"
		,pt=>"Húngaro"
		,ru=>"Венгерский"
		,zh=>"匈牙利语"
		]);}
	public static function txtLang_ia(){ return Lemma::txt([__FUNCTION__
		,en=>"Interlingua"
		,de=>"Interlingua"
		,es=>"Interlingua"
		,it=>"Interlingua"
		,pt=>"Interlíngua"
		,ru=>"Интерлингва"
		,zh=>"国际语"
		]);}
	public static function txtLang_id(){ return Lemma::txt([__FUNCTION__
		,en=>"Indonesian"
		,de=>"Indonesisch"
		,es=>"Indonesio"
		,it=>"Indonesiano"
		,pt=>"Indonésio"
		,ru=>"Индонезийский"
		,zh=>"印尼语"
		]);}
	public static function txtLang_ie(){ return Lemma::txt([__FUNCTION__
		,en=>"Interlingue"
		,de=>"Interlingue"
		,es=>"Interlingua"
		,it=>"Interlingue"
		,pt=>"Interlingue "
		,ru=>"Интерлингва"
		,zh=>"国际语"
		]);}
	public static function txtLang_ga(){ return Lemma::txt([__FUNCTION__
		,en=>"Irish"
		,de=>"Irisch"
		,es=>"Irlandés"
		,it=>"Irlandese"
		,pt=>"Irlandês"
		,ru=>"Ирландский"
		,zh=>"爱尔兰语"
		]);}
	public static function txtLang_ig(){ return Lemma::txt([__FUNCTION__
		,en=>"Igbo"
		,de=>"Igbo"
		,es=>"Igbo"
		,it=>"Igbo"
		,pt=>"Igbo"
		,ru=>"Игбо"
		,zh=>"伊博语"
		]);}
	public static function txtLang_ik(){ return Lemma::txt([__FUNCTION__
		,en=>"Inupiaq"
		,de=>"Inupiaq"
		,es=>"Iñupiaq"
		,it=>"Inupiaq"
		,pt=>"Inupiaque"
		,ru=>"Инупиак"
		,zh=>"伊努皮克语"
		]);}
	public static function txtLang_io(){ return Lemma::txt([__FUNCTION__
		,en=>"Ido"
		,de=>"Ido"
		,es=>"Ido"
		,it=>"Ido"
		,pt=>"Ido"
		,ru=>"Идо"
		,zh=>"伊多语"
		]);}
	public static function txtLang_is(){ return Lemma::txt([__FUNCTION__
		,en=>"Icelandic"
		,de=>"Isländisch"
		,es=>"Islandés"
		,it=>"Islandese"
		,pt=>"Islandês"
		,ru=>"Исландский"
		,zh=>"冰岛语"
		]);}
	public static function txtLang_iu(){ return Lemma::txt([__FUNCTION__
		,en=>"Inuktitut"
		,de=>"Inuktitut"
		,es=>"Inuktitut"
		,it=>"Inuktitut"
		,pt=>"Inuíte (inuctitut)"
		,ru=>"Инуктитут"
		,zh=>"因纽特语"
		]);}
	public static function txtLang_jv(){ return Lemma::txt([__FUNCTION__
		,en=>"Javanese"
		,de=>"Javanesisch"
		,es=>"Javanés"
		,it=>"Giavanese"
		,pt=>"Javanês"
		,ru=>"Яванский"
		,zh=>"爪哇语"
		]);}
	public static function txtLang_kl(){ return Lemma::txt([__FUNCTION__
		,en=>"Kalaallisut"
		,de=>"Kalaallisut"
		,es=>"Kalaallisut"
		,it=>"Kalaallisut"
		,pt=>"Groenlandês"
		,ru=>"Гренландский"
		,zh=>"格陵兰语"
		]);}
	public static function txtLang_kn(){ return Lemma::txt([__FUNCTION__
		,en=>"Kannada"
		,de=>"Kannada"
		,es=>"Canarés"
		,it=>"Kannada"
		,pt=>"Canarês"
		,ru=>"Каннада"
		,zh=>"坎那达语"
		]);}
	public static function txtLang_kr(){ return Lemma::txt([__FUNCTION__
		,en=>"Kanuri"
		,de=>"Kanuri"
		,es=>"Kanuri"
		,it=>"Kanuri"
		,pt=>"Kanuri"
		,ru=>"Канури"
		,zh=>"卡努里语"
		]);}
	public static function txtLang_ks(){ return Lemma::txt([__FUNCTION__
		,en=>"Kashmiri"
		,de=>"Kaschmirisch"
		,es=>"Cachemir"
		,it=>"Kashmiri"
		,pt=>"Caxemira"
		,ru=>"Кашмирский"
		,zh=>"克什米尔语"
		]);}
	public static function txtLang_kk(){ return Lemma::txt([__FUNCTION__
		,en=>"Kazakh"
		,de=>"Kasachisch"
		,es=>"Kazakh"
		,it=>"Kazako"
		,pt=>"Cazaque"
		,ru=>"Казахский"
		,zh=>"哈萨克语"
		]);}
	public static function txtLang_km(){ return Lemma::txt([__FUNCTION__
		,en=>"Khmer"
		,de=>"Khmer"
		,es=>"Khmer"
		,it=>"Khmer"
		,pt=>"Cambojano (Khmer )"
		,ru=>"Кхмерский"
		,zh=>"高棉语"
		]);}
	public static function txtLang_ki(){ return Lemma::txt([__FUNCTION__
		,en=>"Kikuyu"
		,de=>"Kikuyu"
		,es=>"Kikuyu"
		,it=>"Kikuyu"
		,pt=>"Quicuiu"
		,ru=>"Кикуйу"
		,zh=>"基库尤语"
		]);}
	public static function txtLang_rw(){ return Lemma::txt([__FUNCTION__
		,en=>"Kinyarwanda"
		,de=>"Kinyarwanda"
		,es=>"Kinyarwanda"
		,it=>"Kinyarwanda"
		,pt=>"Quiniaruanda (Ruanda)"
		,ru=>"Киньяруанда"
		,zh=>"卢旺达语"
		]);}
	public static function txtLang_ky(){ return Lemma::txt([__FUNCTION__
		,en=>"Kyrgyz"
		,de=>"Kirgisisch"
		,es=>"Kyrgyz"
		,it=>"Kirghiso"
		,pt=>"Quirguiz"
		,ru=>"Киргизский"
		,zh=>"吉尔吉斯坦语"
		]);}
	public static function txtLang_kv(){ return Lemma::txt([__FUNCTION__
		,en=>"Komi"
		,de=>"Komi"
		,es=>"Komi"
		,it=>"Komi"
		,pt=>"Komi"
		,ru=>"Коми"
		,zh=>"科米语"
		]);}
	public static function txtLang_kg(){ return Lemma::txt([__FUNCTION__
		,en=>"Kongo"
		,de=>"Kongolesisch"
		,es=>"Kongo"
		,it=>"Kongo"
		,pt=>"Quicongo"
		,ru=>"Конго"
		,zh=>"刚果语"
		]);}
	public static function txtLang_ku(){ return Lemma::txt([__FUNCTION__
		,en=>"Kurdish"
		,de=>"Kurdisch"
		,es=>"Kurdo"
		,it=>"Curdo"
		,pt=>"Curdo"
		,ru=>"Курдский"
		,zh=>"库尔德语"
		]);}
	public static function txtLang_kj(){ return Lemma::txt([__FUNCTION__
		,en=>"Kwanyama"
		,de=>"Kwanyama"
		,es=>"Kwanyama"
		,it=>"Kwanyama"
		,pt=>"Cuanhama"
		,ru=>"Кваньяма"
		,zh=>"库瓦亚马语"
		]);}
	public static function txtLang_la(){ return Lemma::txt([__FUNCTION__
		,en=>"Latin"
		,de=>"Lateinisch"
		,es=>"Latín"
		,it=>"Latino"
		,pt=>"Latim"
		,ru=>"Латинский"
		,zh=>"拉丁语"
		]);}
	public static function txtLang_lb(){ return Lemma::txt([__FUNCTION__
		,en=>"Luxembourgish"
		,de=>"Luxemburgisch"
		,es=>"Luxemburgués"
		,it=>"Lussemburghese"
		,pt=>"Luxemburguês"
		,ru=>"Люксембургский"
		,zh=>"卢森堡语"
		]);}
	public static function txtLang_lg(){ return Lemma::txt([__FUNCTION__
		,en=>"Ganda"
		,de=>"Ganda"
		,es=>"Ganda"
		,it=>"Ganda"
		,pt=>"Ganda"
		,ru=>"Ганда"
		,zh=>"干达语"
		]);}
	public static function txtLang_li(){ return Lemma::txt([__FUNCTION__
		,en=>"Limburgish"
		,de=>"Limburgisch"
		,es=>"Limburgués"
		,it=>"Limburghese"
		,pt=>"Limburguês"
		,ru=>"Лимбургский"
		,zh=>"林堡语"
		]);}
	public static function txtLang_ln(){ return Lemma::txt([__FUNCTION__
		,en=>"Lingala"
		,de=>"Lingala"
		,es=>"Lingala"
		,it=>"Lingala"
		,pt=>"Lingala"
		,ru=>"Лингала"
		,zh=>"林加拉语"
		]);}
	public static function txtLang_lo(){ return Lemma::txt([__FUNCTION__
		,en=>"Lao"
		,de=>"Laotisch"
		,es=>"Lao"
		,it=>"Lao"
		,pt=>"Laociano"
		,ru=>"Лаосский"
		,zh=>"老挝语"
		]);}
	public static function txtLang_lt(){ return Lemma::txt([__FUNCTION__
		,en=>"Lithuanian"
		,de=>"Litauisch"
		,es=>"Lituano"
		,it=>"Lituano"
		,pt=>"Lituano"
		,ru=>"Литовский"
		,zh=>"立陶宛语"
		]);}
	public static function txtLang_lu(){ return Lemma::txt([__FUNCTION__
		,en=>"Luba-Katanga"
		,de=>"Luba-Katanga"
		,es=>"Luba-Katanga"
		,it=>"Luba-Katanga"
		,pt=>"Luba-Katanga"
		,ru=>"Луба-катанга"
		,zh=>"鲁巴加丹加语"
		]);}
	public static function txtLang_lv(){ return Lemma::txt([__FUNCTION__
		,en=>"Latvian"
		,de=>"Lettisch"
		,es=>"Letón"
		,it=>"Lettone"
		,pt=>"Letão"
		,ru=>"Латышский"
		,zh=>"拉脱维亚语"
		]);}
	public static function txtLang_gv(){ return Lemma::txt([__FUNCTION__
		,en=>"Manx"
		,de=>"Manx"
		,es=>"Manx"
		,it=>"Mannese"
		,pt=>"Manês"
		,ru=>"Мэнский "
		,zh=>"马恩岛语"
		]);}
	public static function txtLang_mk(){ return Lemma::txt([__FUNCTION__
		,en=>"Macedonian"
		,de=>"Mazedonisch"
		,es=>"Macedonio"
		,it=>"Macedone"
		,pt=>"Macedônio"
		,ru=>"Македонский"
		,zh=>"马其顿语"
		]);}
	public static function txtLang_mg(){ return Lemma::txt([__FUNCTION__
		,en=>"Malagasy"
		,de=>"Madagassisch"
		,es=>"Malagasy"
		,it=>"Malgascio"
		,pt=>"Malgaxe"
		,ru=>"Малагасийский"
		,zh=>"马达加斯加语"
		]);}
	public static function txtLang_ms(){ return Lemma::txt([__FUNCTION__
		,en=>"Malay"
		,de=>"Malaiisch"
		,es=>"Malayo"
		,it=>"Malese"
		,pt=>"Malaio"
		,ru=>"Малайский"
		,zh=>"马来语"
		]);}
	public static function txtLang_ml(){ return Lemma::txt([__FUNCTION__
		,en=>"Malayalam"
		,de=>"Malayalam"
		,es=>"Malayalam"
		,it=>"Malayalam"
		,pt=>"Malaiala"
		,ru=>"Малаялам "
		,zh=>"马拉雅拉姆语"
		]);}
	public static function txtLang_mt(){ return Lemma::txt([__FUNCTION__
		,en=>"Maltese"
		,de=>"Maltesisch"
		,es=>"Maltés"
		,it=>"Maltese"
		,pt=>"Maltês"
		,ru=>"Мальтийский  "
		,zh=>"马其他语"
		]);}
	public static function txtLang_mi(){ return Lemma::txt([__FUNCTION__
		,en=>"Māori"
		,de=>"Māori"
		,es=>"Maorí"
		,it=>"Māori"
		,pt=>"Maori"
		,ru=>"Маори"
		,zh=>"毛利语"
		]);}
	public static function txtLang_mr(){ return Lemma::txt([__FUNCTION__
		,en=>"Marathi"
		,de=>"Marathi"
		,es=>"Marathi"
		,it=>"Marathi"
		,pt=>"Marati"
		,ru=>"Маратхи"
		,zh=>"马拉蒂语"
		]);}
	public static function txtLang_mh(){ return Lemma::txt([__FUNCTION__
		,en=>"Marshallese"
		,de=>"Marshallisch"
		,es=>"Marshalés"
		,it=>"Marshallese"
		,pt=>"Marshalês"
		,ru=>"Маршалльский"
		,zh=>"马绍尔语"
		]);}
	public static function txtLang_mn(){ return Lemma::txt([__FUNCTION__
		,en=>"Mongolian"
		,de=>"Mongolisch"
		,es=>"Mongol"
		,it=>"Mongolo"
		,pt=>"Mongol"
		,ru=>"Монгольский"
		,zh=>"蒙古语"
		]);}
	public static function txtLang_na(){ return Lemma::txt([__FUNCTION__
		,en=>"Nauru"
		,de=>"Nauruisch"
		,es=>"Nauru"
		,it=>"Nauru"
		,pt=>"Nauruano"
		,ru=>"Науру"
		,zh=>"瑙鲁语"
		]);}
	public static function txtLang_nv(){ return Lemma::txt([__FUNCTION__
		,en=>"Navajo"
		,de=>"Navajo"
		,es=>"Navajo"
		,it=>"Navajo"
		,pt=>"Navajo"
		,ru=>"Навахский"
		,zh=>"纳瓦霍语"
		]);}
	public static function txtLang_nb(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian Bokmål"
		,de=>"Norwegisch Bokmål "
		,es=>"Noruego Bokmål"
		,it=>"Bokmål norvegese"
		,pt=>"Bokmål norueguês"
		,ru=>"Норвежский (букмол)"
		,zh=>"书面挪威语"
		]);}
	public static function txtLang_nd(){ return Lemma::txt([__FUNCTION__
		,en=>"North Ndebele"
		,de=>"Nord Ndebele"
		,es=>"Ndebele septentrional"
		,it=>"Ndebele del nord"
		,pt=>"Sindbele (Ndebele do norte)"
		,ru=>"Северный ндебеле"
		,zh=>"北恩德贝勒语"
		]);}
	public static function txtLang_ne(){ return Lemma::txt([__FUNCTION__
		,en=>"Nepali"
		,de=>"Nepalesisch"
		,es=>"Nepalí"
		,it=>"Nepalese"
		,pt=>"Nepalês"
		,ru=>"Непальский"
		,zh=>"尼泊尔语"
		]);}
	public static function txtLang_ng(){ return Lemma::txt([__FUNCTION__
		,en=>"Ndonga"
		,de=>"Ndonga"
		,es=>"Ndonga"
		,it=>"Ndonga"
		,pt=>"Ndonga"
		,ru=>"Ндонга"
		,zh=>" 恩敦加语"
		]);}
	public static function txtLang_nn(){ return Lemma::txt([__FUNCTION__
		,en=>"Norwegian Nynorsk"
		,de=>"Norwegisch Nynorsk"
		,es=>"Noruego Nynorsk"
		,it=>"Nynorsk norvegese"
		,pt=>"Nynorsk norueguês (novo norueguês)"
		,ru=>"Норвежский (нюнорск)"
		,zh=>"挪威尼诺斯克语"
		]);}
	public static function txtLang_ii(){ return Lemma::txt([__FUNCTION__
		,en=>"Nuosu"
		,de=>"Nuosu"
		,es=>"Nuosu"
		,it=>"Nuosu"
		,pt=>"Nuosu"
		,ru=>"Носу"
		,zh=>"彝语"
		]);}
	public static function txtLang_nr(){ return Lemma::txt([__FUNCTION__
		,en=>"South Ndebele"
		,de=>"Süd Ndebele"
		,es=>"Ndebele meridional"
		,it=>"Ndebele del sud"
		,pt=>"Ndebele do Sul (isiNdebele)"
		,ru=>"Южный ндебеле"
		,zh=>"南恩德贝勒语"
		]);}
	public static function txtLang_oc(){ return Lemma::txt([__FUNCTION__
		,en=>"Occitan"
		,de=>"Okzitanisch"
		,es=>"Occitano"
		,it=>"Occitano"
		,pt=>"Occitano (Provençal)"
		,ru=>"Окситанский"
		,zh=>"奥克西唐语"
		]);}
	public static function txtLang_oj(){ return Lemma::txt([__FUNCTION__
		,en=>"Ojibwe"
		,de=>"Ojibwe"
		,es=>"Ojibwa"
		,it=>"Ojibwe"
		,pt=>"Ojíbua (Anishinaabemowin)"
		,ru=>"Оджибве"
		,zh=>"奥杰布瓦语"
		]);}
	public static function txtLang_cu(){ return Lemma::txt([__FUNCTION__
		,en=>"Old Slavonic"
		,de=>"Alt-Slowenisch"
		,es=>"Eslavo Antiguo"
		,it=>"Slavo antico"
		,pt=>"Protoeslavo"
		,ru=>"Старославянский"
		,zh=>"古教会斯拉夫语"
		]);}
	public static function txtLang_om(){ return Lemma::txt([__FUNCTION__
		,en=>"Oromo"
		,de=>"Oromo"
		,es=>"Oromo"
		,it=>"Oromo"
		,pt=>"Oromo"
		,ru=>"Оромо"
		,zh=>"奥罗莫语"
		]);}
	public static function txtLang_or(){ return Lemma::txt([__FUNCTION__
		,en=>"Oriya"
		,de=>"Oriya"
		,es=>"Oriya"
		,it=>"Oriya"
		,pt=>"Oriá"
		,ru=>"Ория"
		,zh=>"奥里亚语"
		]);}
	public static function txtLang_os(){ return Lemma::txt([__FUNCTION__
		,en=>"Ossetian"
		,de=>"Ossetisch"
		,es=>"Osetio"
		,it=>"Osseto"
		,pt=>"Osseto"
		,ru=>"Осетинский"
		,zh=>"奥塞特语"
		]);}
	public static function txtLang_pa(){ return Lemma::txt([__FUNCTION__
		,en=>"Panjabi"
		,de=>"Panjabi"
		,es=>"Panyabí"
		,it=>"Panjabi"
		,pt=>"Panjabi ou punjabi"
		,ru=>"Пенджабский"
		,zh=>"旁遮普语"
		]);}
	public static function txtLang_pi(){ return Lemma::txt([__FUNCTION__
		,en=>"Pāli"
		,de=>"Pāli"
		,es=>"Pāli"
		,it=>"Pāli"
		,pt=>"Páli"
		,ru=>"Пали"
		,zh=>"巴利语"
		]);}
	public static function txtLang_fa(){ return Lemma::txt([__FUNCTION__
		,en=>"Farsi"
		,de=>"Farsi"
		,es=>"Persa"
		,it=>"Farsi"
		,pt=>"Persa (Farsi)"
		,ru=>"Фарси"
		,zh=>"波斯语"
		]);}
	public static function txtLang_ps(){ return Lemma::txt([__FUNCTION__
		,en=>"Pashto"
		,de=>"Pashto"
		,es=>"Pastún"
		,it=>"Pashto"
		,pt=>"Afegão (Pachto)"
		,ru=>"Пушту"
		,zh=>"普什图语"
		]);}
	public static function txtLang_qu(){ return Lemma::txt([__FUNCTION__
		,en=>"Quechua"
		,de=>"Quechua"
		,es=>"Quechua"
		,it=>"Quechua"
		,pt=>"Quechua"
		,ru=>"Кечуа"
		,zh=>"盖丘亚语"
		]);}
	public static function txtLang_rm(){ return Lemma::txt([__FUNCTION__
		,en=>"Romansh"
		,de=>"Rätoromanisch"
		,es=>"Romanche"
		,it=>"Romancio"
		,pt=>"Romanche"
		,ru=>"Романшский"
		,zh=>"罗曼什语"
		]);}
	public static function txtLang_rn(){ return Lemma::txt([__FUNCTION__
		,en=>"Kirundi"
		,de=>"Kirundi"
		,es=>"Kirundi"
		,it=>"Kirundi"
		,pt=>"Kirundi"
		,ru=>"Кирунди"
		,zh=>"基隆迪语"
		]);}
	public static function txtLang_ro(){ return Lemma::txt([__FUNCTION__
		,en=>"Romanian"
		,de=>"Rumänisch"
		,es=>"Rumano"
		,it=>"Romeno"
		,pt=>"Romeno"
		,ru=>"Румынский"
		,zh=>"罗马尼亚语"
		]);}
	public static function txtLang_sa(){ return Lemma::txt([__FUNCTION__
		,en=>"Sanskrit"
		,de=>"Sanskrit"
		,es=>"Sánscrito"
		,it=>"Sanscrito"
		,pt=>"Sânscrito"
		,ru=>"Санскрит"
		,zh=>"梵语"
		]);}
	public static function txtLang_sc(){ return Lemma::txt([__FUNCTION__
		,en=>"Sardinian"
		,de=>"Sardisch"
		,es=>"Sardo"
		,it=>"Sardo"
		,pt=>"Sardo ou sardenho"
		,ru=>"Сардинский"
		,zh=>"撒丁语"
		]);}
	public static function txtLang_sd(){ return Lemma::txt([__FUNCTION__
		,en=>"Sindhi"
		,de=>"Sindhi"
		,es=>"Sindhi"
		,it=>"Sindhi"
		,pt=>"Sindi"
		,ru=>"Синдхи"
		,zh=>"信德语"
		]);}
	public static function txtLang_se(){ return Lemma::txt([__FUNCTION__
		,en=>"Northern Sami"
		,de=>"Nordsamisch"
		,es=>"Sami septentrional"
		,it=>"Sami settentrionale"
		,pt=>"Sami setentrional"
		,ru=>"Северносаамский"
		,zh=>"北方萨米语"
		]);}
	public static function txtLang_sm(){ return Lemma::txt([__FUNCTION__
		,en=>"Samoan"
		,de=>"Samoanisch"
		,es=>"Samoano"
		,it=>"Samoano"
		,pt=>"Samoano"
		,ru=>"Самоанский"
		,zh=>"萨摩亚语"
		]);}
	public static function txtLang_sg(){ return Lemma::txt([__FUNCTION__
		,en=>"Sango"
		,de=>"Sango"
		,es=>"Sango"
		,it=>"Sango"
		,pt=>"Sango"
		,ru=>"Санго"
		,zh=>"桑戈语"
		]);}
	public static function txtLang_sr(){ return Lemma::txt([__FUNCTION__
		,en=>"Serbian"
		,de=>"Serbisch"
		,es=>"Serbio"
		,it=>"Serbo"
		,pt=>"Sérvio"
		,ru=>"Сербский"
		,zh=>"塞尔维亚语"
		]);}
	public static function txtLang_gd(){ return Lemma::txt([__FUNCTION__
		,en=>"Scottish Gaelic"
		,de=>"Schottisch-Gälisch "
		,es=>"Gaélico escocés"
		,it=>"Gaelico scozzese"
		,pt=>"Gaélico escocês"
		,ru=>"Шотландский"
		,zh=>"苏格兰盖立语"
		]);}
	public static function txtLang_sn(){ return Lemma::txt([__FUNCTION__
		,en=>"Shona"
		,de=>"Shona"
		,es=>"Shona"
		,it=>"Shona"
		,pt=>"ChiXona"
		,ru=>"Шона"
		,zh=>"修纳语"
		]);}
	public static function txtLang_si(){ return Lemma::txt([__FUNCTION__
		,en=>"Sinhala"
		,de=>"Sinhala"
		,es=>"Cingalés"
		,it=>"Sinhala"
		,pt=>"Cingalês"
		,ru=>"Сингальский"
		,zh=>"僧伽罗语"
		]);}
	public static function txtLang_sk(){ return Lemma::txt([__FUNCTION__
		,en=>"Slovak"
		,de=>"Slowakisch"
		,es=>"Eslovaco"
		,it=>"Slovacco"
		,pt=>"Eslovaco"
		,ru=>"Словацкий"
		,zh=>"斯洛伐克语"
		]);}
	public static function txtLang_sl(){ return Lemma::txt([__FUNCTION__
		,en=>"Slovene"
		,de=>"Slowenisch"
		,es=>"Esloveno"
		,it=>"Sloveno"
		,pt=>"Esloveno"
		,ru=>"Словенский"
		,zh=>"斯洛文尼亚语"
		]);}
	public static function txtLang_so(){ return Lemma::txt([__FUNCTION__
		,en=>"Somali"
		,de=>"Somalisch"
		,es=>"Somalí"
		,it=>"Somalo"
		,pt=>"Somali"
		,ru=>"Сомалийский"
		,zh=>"索马里语"
		]);}
	public static function txtLang_st(){ return Lemma::txt([__FUNCTION__
		,en=>"Southern Sotho"
		,de=>"Süd-Sotho"
		,es=>"Sesotho"
		,it=>"Sotho meridionale"
		,pt=>"Soto do Sul"
		,ru=>"Южный сото"
		,zh=>"南索托语"
		]);}
	public static function txtLang_su(){ return Lemma::txt([__FUNCTION__
		,en=>"Sundanese"
		,de=>"Sudanesisch"
		,es=>"Sondanés"
		,it=>"Sudanese"
		,pt=>"Sudanês"
		,ru=>"Сунданский"
		,zh=>"巽他语"
		]);}
	public static function txtLang_sw(){ return Lemma::txt([__FUNCTION__
		,en=>"Swahili"
		,de=>"Swahili"
		,es=>"Suahili"
		,it=>"Swahili"
		,pt=>"Suaíli"
		,ru=>"Суахили"
		,zh=>" 巽他语"
		]);}
	public static function txtLang_ss(){ return Lemma::txt([__FUNCTION__
		,en=>"Swati"
		,de=>"Swati"
		,es=>"Suazi"
		,it=>"Swati"
		,pt=>"Suazilandês"
		,ru=>"Свати"
		,zh=>"斯瓦蒂语"
		]);}
	public static function txtLang_ta(){ return Lemma::txt([__FUNCTION__
		,en=>"Tamil"
		,de=>"Tamil"
		,es=>"Tamil"
		,it=>"Tamil"
		,pt=>"Tâmil"
		,ru=>"Тамильский"
		,zh=>"泰米尔语"
		]);}
	public static function txtLang_te(){ return Lemma::txt([__FUNCTION__
		,en=>"Telugu"
		,de=>"Telugu"
		,es=>"Telugu"
		,it=>"Telugu"
		,pt=>"Telugu"
		,ru=>"Телугу"
		,zh=>"泰卢固语"
		]);}
	public static function txtLang_tg(){ return Lemma::txt([__FUNCTION__
		,en=>"Tajik"
		,de=>"Tadschikisch "
		,es=>"Tajik"
		,it=>"Tajik"
		,pt=>"Tajique ou tadjique"
		,ru=>"Таджикский"
		,zh=>"塔吉克语"
		]);}
	public static function txtLang_th(){ return Lemma::txt([__FUNCTION__
		,en=>"Thai"
		,de=>"Thailändisch"
		,es=>"Tailandés"
		,it=>"Thai"
		,pt=>"Tailandês"
		,ru=>"Тайландский"
		,zh=>"泰语"
		]);}
	public static function txtLang_ti(){ return Lemma::txt([__FUNCTION__
		,en=>"Tigrinya"
		,de=>"Tigrinya"
		,es=>"Tigriña"
		,it=>"Tigrinya"
		,pt=>"Tigrínia"
		,ru=>"Тигринья"
		,zh=>"提格利尼亚语"
		]);}
	public static function txtLang_bo(){ return Lemma::txt([__FUNCTION__
		,en=>"Tibetan"
		,de=>"Tibetisch"
		,es=>"Tibetano"
		,it=>"Tibetano"
		,pt=>"Tibetano"
		,ru=>"Тибетский"
		,zh=>"藏语"
		]);}
	public static function txtLang_tk(){ return Lemma::txt([__FUNCTION__
		,en=>"Turkmen"
		,de=>"Turkmenisch"
		,es=>"Turcomano"
		,it=>"Turkmeno"
		,pt=>"Turcomeno, turcomano"
		,ru=>"Туркменский"
		,zh=>"土库曼语"
		]);}
	public static function txtLang_tl(){ return Lemma::txt([__FUNCTION__
		,en=>"Tagalog"
		,de=>"Tagalong"
		,es=>"Tagalo"
		,it=>"Tagalog"
		,pt=>"Tagalog, pilipino ou filipino"
		,ru=>"Тагальский"
		,zh=>"塔加拉族语"
		]);}
	public static function txtLang_tn(){ return Lemma::txt([__FUNCTION__
		,en=>"Tswana"
		,de=>"Tswana"
		,es=>"Tswana"
		,it=>"Tswana"
		,pt=>"Tsuana"
		,ru=>"Тсвана"
		,zh=>"班图语"
		]);}
	public static function txtLang_to(){ return Lemma::txt([__FUNCTION__
		,en=>"Tonga"
		,de=>"Tongalesisch"
		,es=>"Tonga"
		,it=>"Tonga"
		,pt=>"Tonganês"
		,ru=>"Тонганский"
		,zh=>"茨瓦纳语"
		]);}
	public static function txtLang_tr(){ return Lemma::txt([__FUNCTION__
		,en=>"Turkish"
		,de=>"Türkisch"
		,es=>"Turco"
		,it=>"Turco"
		,pt=>"Turco"
		,ru=>"Турецкий"
		,zh=>"土耳其语"
		]);}
	public static function txtLang_ts(){ return Lemma::txt([__FUNCTION__
		,en=>"Tsonga"
		,de=>"Tsonga"
		,es=>"Tsonga"
		,it=>"Tsonga"
		,pt=>"Tsonga"
		,ru=>"Тсонга "
		,zh=>"聪加语"
		]);}
	public static function txtLang_tt(){ return Lemma::txt([__FUNCTION__
		,en=>"Tatar"
		,de=>"Tatarisch"
		,es=>"Tártaro"
		,it=>"Tataro"
		,pt=>"Tártaro"
		,ru=>"Татарский"
		,zh=>"鞑靼语"
		]);}
	public static function txtLang_tw(){ return Lemma::txt([__FUNCTION__
		,en=>"Twi"
		,de=>"Twi"
		,es=>"Twi"
		,it=>"Twi"
		,pt=>"Twi (ashanti)"
		,ru=>"Тви"
		,zh=>"特维语"
		]);}
	public static function txtLang_ty(){ return Lemma::txt([__FUNCTION__
		,en=>"Tahitian"
		,de=>"Tahitisch"
		,es=>"Tahitiano"
		,it=>"Tahitiano"
		,pt=>"Taitiano"
		,ru=>"Таитянский"
		,zh=>"塔希提语"
		]);}
	public static function txtLang_ug(){ return Lemma::txt([__FUNCTION__
		,en=>"Uyghur"
		,de=>" Uighurisch"
		,es=>"Iugur"
		,it=>"Uyghur"
		,pt=>"Uigur"
		,ru=>"Уйгурский "
		,zh=>"维吾尔语"
		]);}
	public static function txtLang_uk(){ return Lemma::txt([__FUNCTION__
		,en=>"Ukrainian"
		,de=>"Ukrainisch"
		,es=>"Ucraniano"
		,it=>"Ucraino"
		,pt=>"Ucraniano"
		,ru=>"Украинский"
		,zh=>"乌克兰语"
		]);}
	public static function txtLang_ur(){ return Lemma::txt([__FUNCTION__
		,en=>"Urdu"
		,de=>"Urdu"
		,es=>"Urdu"
		,it=>"Urdu"
		,pt=>"Urdu"
		,ru=>"Урду"
		,zh=>"乌尔都语"
		]);}
	public static function txtLang_uz(){ return Lemma::txt([__FUNCTION__
		,en=>"Uzbek"
		,de=>"Usbekisch"
		,es=>"Uzbeko"
		,it=>"Uzbeco"
		,pt=>"Uzbeque"
		,ru=>"Узбекский"
		,zh=>"乌兹别克语"
		]);}
	public static function txtLang_ve(){ return Lemma::txt([__FUNCTION__
		,en=>"Venda"
		,de=>"Venda"
		,es=>"Venda"
		,it=>"Venda"
		,pt=>"Venda"
		,ru=>"Венда"
		,zh=>"文达语"
		]);}
	public static function txtLang_vi(){ return Lemma::txt([__FUNCTION__
		,en=>"Vietnamese"
		,de=>" Vietnamesisch"
		,es=>"Vietnamita"
		,it=>"Vietnamita"
		,pt=>"Vietnamita"
		,ru=>"Вьетнамский"
		,zh=>"越南语"
		]);}
	public static function txtLang_vo(){ return Lemma::txt([__FUNCTION__
		,en=>"Volapük"
		,de=>"Volapük"
		,es=>"Volapük"
		,it=>"Volapük"
		,pt=>"Volapuque"
		,ru=>"Волапюк"
		,zh=>"沃拉普克语"
		]);}
	public static function txtLang_wa(){ return Lemma::txt([__FUNCTION__
		,en=>"Walloon"
		,de=>"Wallonisch"
		,es=>"Valón"
		,it=>"Vallone"
		,pt=>"Valão"
		,ru=>"Валлонский"
		,zh=>"瓦隆语"
		]);}
	public static function txtLang_cy(){ return Lemma::txt([__FUNCTION__
		,en=>"Welsh"
		,de=>"Walisisch"
		,es=>"Galés"
		,it=>"Gallese"
		,pt=>"Galês (Cymraeg)"
		,ru=>"Валлийский"
		,zh=>"威尔士语"
		]);}
	public static function txtLang_wo(){ return Lemma::txt([__FUNCTION__
		,en=>"Wolof"
		,de=>"Wolof"
		,es=>"Wolof"
		,it=>"Wolof"
		,pt=>"Uólofe (Wolof)"
		,ru=>"Волоф"
		,zh=>"沃洛夫语"
		]);}
	public static function txtLang_fy(){ return Lemma::txt([__FUNCTION__
		,en=>"Western Frisian"
		,de=>"Westfriesisch"
		,es=>"Frisón occidental"
		,it=>"Frisone occidentale"
		,pt=>"Frísio, Frisão ocidental"
		,ru=>"Западнофризский"
		,zh=>"西弗里西亚语"
		]);}
	public static function txtLang_xh(){ return Lemma::txt([__FUNCTION__
		,en=>"Xhosa"
		,de=>"Xhosa"
		,es=>"Xhosa"
		,it=>"Xhosa"
		,pt=>"Xhosa"
		,ru=>"Кхоса "
		,zh=>" 科萨语"
		]);}
	public static function txtLang_yi(){ return Lemma::txt([__FUNCTION__
		,en=>"Yiddish"
		,de=>"Jiddisch"
		,es=>"Yidis"
		,it=>"Yiddish"
		,pt=>"Iídiche"
		,ru=>"Идиш"
		,zh=>"意第绪语"
		]);}
	public static function txtLang_yo(){ return Lemma::txt([__FUNCTION__
		,en=>"Yoruba"
		,de=>"Yoruba"
		,es=>"Yoruba"
		,it=>"Yoruba"
		,pt=>"Iorubá / Yoruba"
		,ru=>"Йоруба"
		,zh=>"约鲁巴语"
		]);}
	public static function txtLang_za(){ return Lemma::txt([__FUNCTION__
		,en=>"Zhuang"
		,de=>"Zhuang"
		,es=>"Zhuang"
		,it=>"Zhuang"
		,pt=>"Zhuang"
		,ru=>"Чжуанский"
		,zh=>"壮语"
		]);}
	public static function txtLang_zu(){ return Lemma::txt([__FUNCTION__
		,en=>"Zulu"
		,de=>"Zulu"
		,es=>"Zulú"
		,it=>"Zulu"
		,pt=>"Zulu"
		,ru=>"Зулусский"
		,zh=>"祖鲁语"
		]);}



	public static function txtCountry_($x) { return static::txt(__FUNCTION__,$x); }
	public static function txtCountry_AD(){ return Lemma::txt([__FUNCTION__
		,en=>"ANDORRA"
		,fr=>"ANDORRE"
		,de=>"ANDORRA"
		,es=>"ANDORRA"
		,it=>"ANDORRA"
		,pt=>"ANDORRA"
		,ru=>"АНДОРРА"
		,zh=>"安道尔"
		]);}
	public static function txtCountry_AE(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED ARAB EMIRATES"
		,fr=>"ÉMIRATS ARABES UNIS"
		,de=>"VEREINIGTE ARABISCHE EMIRATE"
		,es=>"EMIRATOS ÁRABES UNIDOS"
		,it=>"EMIRATI ARABI UNITI"
		,pt=>"EMIRADOS ÁRABES UNIDOS"
		,ru=>"ОБЪЕДИНЕННЫЕ АРАБСКИЕ ЭМИРАТЫ"
		,zh=>"阿联酋"
		]);}
	public static function txtCountry_AF(){ return Lemma::txt([__FUNCTION__
		,en=>"AFGHANISTAN"
		,fr=>"AFGHANISTAN"
		,de=>"AFGHANISTAN"
		,es=>"AFGANISTÁN"
		,it=>"AFGHANISTAN"
		,pt=>"AFEGANISTÃO"
		,ru=>"АФГАНИСТАН"
		,zh=>"阿富汗"
		]);}
	public static function txtCountry_AG(){ return Lemma::txt([__FUNCTION__
		,en=>"ANTIGUA AND BARBUDA"
		,fr=>"ANTIGUA-ET-BARBUDA"
		,de=>"ANTIGUA UND BARBUDA"
		,es=>"ANTIGUA Y BARBUDA"
		,it=>"ANTIGUA E BARBUDA"
		,pt=>"ANTÍGUA E BARBUDA"
		,ru=>"АНТИГУА И БАРБУДА"
		,zh=>"安提瓜和巴布达"
		]);}
	public static function txtCountry_AI(){ return Lemma::txt([__FUNCTION__
		,en=>"ANGUILLA"
		,fr=>"ANGUILLA"
		,de=>"ANGUILLA"
		,es=>"ANGUILA"
		,it=>"ANGUILLA"
		,pt=>"ANGUILLA"
		,ru=>"АНГИЛЬЯ"
		,zh=>"安圭拉"
		]);}
	public static function txtCountry_AL(){ return Lemma::txt([__FUNCTION__
		,en=>"ALBANIA"
		,fr=>"ALBANIE"
		,de=>"ALBANIEN"
		,es=>"ALBANIA"
		,it=>"ALBANIA"
		,pt=>"ALBÂNIA"
		,ru=>"АЛБАНИЯ"
		,zh=>"阿尔巴尼亚"
		]);}
	public static function txtCountry_AM(){ return Lemma::txt([__FUNCTION__
		,en=>"ARMENIA"
		,fr=>"ARMÉNIE"
		,de=>"ARMENIEN"
		,es=>"ARMENIA"
		,it=>"ARMENIA"
		,pt=>"ARMÊNIA"
		,ru=>"АРМЕНИЯ"
		,zh=>"亚美尼亚"
		]);}
	public static function txtCountry_AO(){ return Lemma::txt([__FUNCTION__
		,en=>"ANGOLA"
		,fr=>"ANGOLA"
		,de=>"ANGOLA"
		,es=>"ANGOLA"
		,it=>"ANGOLA"
		,pt=>"ANGOLA"
		,ru=>"АНГОЛА"
		,zh=>"安哥拉"
		]);}
	public static function txtCountry_AQ(){ return Lemma::txt([__FUNCTION__
		,en=>"ANTARCTICA"
		,fr=>"ANTARCTIQUE"
		,de=>"ANTARKTIK"
		,es=>"ANTÁRTIDA"
		,it=>"ANTARTIDE"
		,pt=>"ANTÁRTIDA"
		,ru=>"АНТАРКТИДА"
		,zh=>"南极洲"
		]);}
	public static function txtCountry_AR(){ return Lemma::txt([__FUNCTION__
		,en=>"ARGENTINA"
		,fr=>"ARGENTINE"
		,de=>"ARGENTINIEN"
		,es=>"ARGENTINA"
		,it=>"ARGENTINA"
		,pt=>"ARGENTINA"
		,ru=>"АРГЕНТИНА"
		,zh=>"阿根廷"
		]);}
	public static function txtCountry_AS(){ return Lemma::txt([__FUNCTION__
		,en=>"AMERICAN SAMOA"
		,fr=>"SAMOA AMÉRICAINES"
		,de=>"AMERIKANISCH SAMOA"
		,es=>"SAMOA AMERICANA"
		,it=>"SAMOA AMERICANE"
		,pt=>"SAMOA AMERICANA"
		,ru=>"АМЕРИКАНСКОЕ САМОА"
		,zh=>"美属萨摩亚"
		]);}
	public static function txtCountry_AT(){ return Lemma::txt([__FUNCTION__
		,en=>"AUSTRIA"
		,fr=>"AUTRICHE"
		,de=>"ÖSTERREICH"
		,es=>"AUSTRIA"
		,it=>"AUSTRIA"
		,pt=>"ÁUSTRIA"
		,ru=>"АВСТРИЯ"
		,zh=>"奥地利"
		]);}
	public static function txtCountry_AU(){ return Lemma::txt([__FUNCTION__
		,en=>"AUSTRALIA"
		,fr=>"AUSTRALIE"
		,de=>"AUSTRALIE"
		,es=>"AUSTRALIA"
		,it=>"AUSTRALIA"
		,pt=>"AUSTRÁLIA"
		,ru=>"АВСТРАЛИЯ"
		,zh=>"澳大利亚"
		]);}
	public static function txtCountry_AW(){ return Lemma::txt([__FUNCTION__
		,en=>"ARUBA"
		,fr=>"ARUBA"
		,de=>"ARUBA"
		,es=>"ARUBA"
		,it=>"ARUBA"
		,pt=>"ARUBA"
		,ru=>"АРУБА"
		,zh=>"阿鲁巴"
		]);}
	public static function txtCountry_AX(){ return Lemma::txt([__FUNCTION__
		,en=>"ÅLAND ISLANDS"
		,fr=>"ÅLAND, ÎLES"
		,de=>"ALAND-INSELN"
		,es=>"ÅLAND, ISLAS"
		,it=>"ISOLE ÅLAND"
		,pt=>"ILHAS ALANDA"
		,ru=>"АЛАНДСКИЕ ОСТРОВА"
		,zh=>"奥兰群岛"
		]);}
	public static function txtCountry_AZ(){ return Lemma::txt([__FUNCTION__
		,en=>"AZERBAIJAN"
		,fr=>"AZERBAÏDJAN"
		,de=>"ASERBEIDSCHAN"
		,es=>"AZERBAIYÁN"
		,it=>"AZERBAIGIAN"
		,pt=>"AZERBAIJÃO"
		,ru=>"АЗЕРБАЙДЖАН"
		,zh=>"阿塞拜疆"
		]);}
	public static function txtCountry_BA(){ return Lemma::txt([__FUNCTION__
		,en=>"BOSNIA AND HERZEGOVINA"
		,fr=>"BOSNIE-HERZÉGOVINE"
		,de=>"BOSNIEN HERZEGOVINA"
		,es=>"BOSNIA-HERZEGOVINA"
		,it=>"BOSNIA ED ERZEGOVINA"
		,pt=>"BÓSNIA-HERZEGOVINA"
		,ru=>"БОСНИЯ И ГЕРЦЕГОВИНА"
		,zh=>"波斯尼亚和黑塞哥维那"
		]);}
	public static function txtCountry_BB(){ return Lemma::txt([__FUNCTION__
		,en=>"BARBADOS"
		,fr=>"BARBADE"
		,de=>"BARBADOS"
		,es=>"BARBADOS"
		,it=>"BARBADOS"
		,pt=>"BARBADOS"
		,ru=>"БАРБАДОС"
		,zh=>"巴巴多斯"
		]);}
	public static function txtCountry_BD(){ return Lemma::txt([__FUNCTION__
		,en=>"BANGLADESH"
		,fr=>"BANGLADESH"
		,de=>"BANGLADESH"
		,es=>"BANGLADÉS"
		,it=>"BANGLADESH"
		,pt=>"BANGLADESH"
		,ru=>"БАНГЛАДЕШ"
		,zh=>"孟加拉国"
		]);}
	public static function txtCountry_BE(){ return Lemma::txt([__FUNCTION__
		,en=>"BELGIUM"
		,fr=>"BELGIQUE"
		,de=>"BELGIEN"
		,es=>"BÉLGICA"
		,it=>"BELGIO"
		,pt=>"BÉLGICA"
		,ru=>"БЕЛЬГИЯ"
		,zh=>"比利时"
		]);}
	public static function txtCountry_BF(){ return Lemma::txt([__FUNCTION__
		,en=>"BURKINA FASO"
		,fr=>"BURKINA FASO"
		,de=>"BURKINA FASO"
		,es=>"BURKINA FASO"
		,it=>"BURKINA FASO"
		,pt=>"BURQUINA FASO"
		,ru=>"БУРКИНА-ФАСО"
		,zh=>"布基纳法索"
		]);}
	public static function txtCountry_BG(){ return Lemma::txt([__FUNCTION__
		,en=>"BULGARIA"
		,fr=>"BULGARIE"
		,de=>"BULGARIEN"
		,es=>"BULGARIA"
		,it=>"BULGARIA"
		,pt=>"BULGÁRIA"
		,ru=>"БОЛГАРИЯ"
		,zh=>"保加利亚"
		]);}
	public static function txtCountry_BH(){ return Lemma::txt([__FUNCTION__
		,en=>"BAHRAIN"
		,fr=>"BAHREÏN"
		,de=>"BAHREIN"
		,es=>"BARÉIN"
		,it=>"BAHREIN"
		,pt=>"BARÉM"
		,ru=>"БАХРЕЙН"
		,zh=>"巴林"
		]);}
	public static function txtCountry_BI(){ return Lemma::txt([__FUNCTION__
		,en=>"BURUNDI"
		,fr=>"BURUNDI"
		,de=>"BURUNDI"
		,es=>"BURUNDI"
		,it=>"BURUNDI"
		,pt=>"BURUNDI"
		,ru=>"БУРУНДИ"
		,zh=>"布隆迪"
		]);}
	public static function txtCountry_BJ(){ return Lemma::txt([__FUNCTION__
		,en=>"BENIN"
		,fr=>"BÉNIN"
		,de=>"BENIN"
		,es=>"BENÍN"
		,it=>"BENIN"
		,pt=>"BENIM"
		,ru=>"БЕНИН"
		,zh=>"贝宁"
		]);}
	public static function txtCountry_BL(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT BARTHÉLEMY"
		,fr=>"SAINT-BARTHÉLEMY"
		,de=>"SAINT BARTHÉLEMY"
		,es=>"SAN BARTOLOMÉ"
		,it=>"SAINT BARTHÉLEMY"
		,pt=>"SÃO BARTOLOMEU"
		,ru=>"О. СЕН-БАРТЕЛЕМИ"
		,zh=>"圣巴托洛缪岛"
		]);}
	public static function txtCountry_BM(){ return Lemma::txt([__FUNCTION__
		,en=>"BERMUDA"
		,fr=>"BERMUDES"
		,de=>"BERMUDA"
		,es=>"BERMUDAS"
		,it=>"BERMUDA"
		,pt=>"BERMUDA"
		,ru=>"БЕРМУДСКИЕ ОСТРОВА"
		,zh=>"百慕大"
		]);}
	public static function txtCountry_BN(){ return Lemma::txt([__FUNCTION__
		,en=>"BRUNEI DARUSSALAM"
		,fr=>"BRUNÉI DARUSSALAM"
		,de=>"BRUNEI DARUSSALAM"
		,es=>"BRUNÉIS DARUSSALAM"
		,it=>"BRUNEI DARUSSALAM"
		,pt=>"BRUNEI"
		,ru=>"БРУНЕЙ-ДАРУССАЛАМ"
		,zh=>"文莱达鲁萨兰国"
		]);}
	public static function txtCountry_BO(){ return Lemma::txt([__FUNCTION__
		,en=>"BOLIVIA, PLURINATIONAL STATE OF"
		,fr=>"BOLIVIE, L'ÉTAT PLURINATIONAL DE"
		,de=>"BOLIVIEN, PLURINATIONALER STAAT"
		,es=>"BOLIVIA, ESTADO PLURINACIONAL DE"
		,it=>"BOLIVIA"
		,pt=>"BOLÍVIA, ESTADO PLURINACIONAL DA BOLÍVIA"
		,ru=>"МНОГОНАЦИОНАЛЬНОЕ ГОСУДАРСТВО БОЛИВИЯ"
		,zh=>"多民族国家玻利维亚"
		]);}
	public static function txtCountry_BQ(){ return Lemma::txt([__FUNCTION__
		,en=>"BONAIRE, SAINT EUSTATIUS AND SABA"
		,fr=>"BONAIRE, SAINT-EUSTACHE ET SABA"
		,de=>"BONAIRE, SAINT EUSTATIUS UND SABA"
		,es=>"BONAIRE, SAN EUSTAQUIO Y SABA"
		,it=>"BONAIRE, SINT EUSTATIUS E SABA"
		,pt=>"BONAIRE, SANTO EUSTÁQUIO E SABA"
		,ru=>"БОНАЙРЕ, СИНТ-ЭСТАТИУС И САБА"
		,zh=>"博内尔岛，圣尤斯特歇斯岛和萨巴岛"
		]);}
	public static function txtCountry_BR(){ return Lemma::txt([__FUNCTION__
		,en=>"BRAZIL"
		,fr=>"BRÉSIL"
		,de=>"BRASILIEN"
		,es=>"BRASIL"
		,it=>"BRASILE"
		,pt=>"BRASIL"
		,ru=>"БРАЗИЛИЯ"
		,zh=>"巴西"
		]);}
	public static function txtCountry_BS(){ return Lemma::txt([__FUNCTION__
		,en=>"BAHAMAS"
		,fr=>"BAHAMAS"
		,de=>"BAHAMAS"
		,es=>"BAHAMAS"
		,it=>"BAHAMAS"
		,pt=>"BAHAMAS"
		,ru=>"БАГАМСКИЕ ОСТРОВА"
		,zh=>"巴哈马"
		]);}
	public static function txtCountry_BT(){ return Lemma::txt([__FUNCTION__
		,en=>"BHUTAN"
		,fr=>"BHOUTAN"
		,de=>"BHUTAN"
		,es=>"BUTÁN"
		,it=>"BHUTAN"
		,pt=>"BUTÃO"
		,ru=>"БУТАН"
		,zh=>"不丹"
		]);}
	public static function txtCountry_BV(){ return Lemma::txt([__FUNCTION__
		,en=>"BOUVET ISLAND"
		,fr=>"BOUVET, ÎLE"
		,de=>"BOUVET-INSEL"
		,es=>"BOUVET, ISLA"
		,it=>"ISOLA BOUVET"
		,pt=>"ILHA BOUVET"
		,ru=>"О. БУВЕ"
		,zh=>"布维岛"
		]);}
	public static function txtCountry_BW(){ return Lemma::txt([__FUNCTION__
		,en=>"BOTSWANA"
		,fr=>"BOTSWANA"
		,de=>"BOTSWANA"
		,es=>"BOTSUANA"
		,it=>"BOTSWANA"
		,pt=>"BOTSUANA"
		,ru=>"БОТСВАНА"
		,zh=>"博茨瓦纳"
		]);}
	public static function txtCountry_BY(){ return Lemma::txt([__FUNCTION__
		,en=>"BELARUS"
		,fr=>"BÉLARUS"
		,de=>"BELARUS"
		,es=>"BIELORRUSIA"
		,it=>"BIELORUSSIA"
		,pt=>"BIELORRÚSSIA"
		,ru=>"БЕЛАРУСЬ"
		,zh=>"白俄罗斯"
		]);}
	public static function txtCountry_BZ(){ return Lemma::txt([__FUNCTION__
		,en=>"BELIZE"
		,fr=>"BELIZE"
		,de=>"BELIZE"
		,es=>"BELICE"
		,it=>"BELIZE"
		,pt=>"BELIZE"
		,ru=>"БЕЛИЗ"
		,zh=>"伯利兹"
		]);}
	public static function txtCountry_CA(){ return Lemma::txt([__FUNCTION__
		,en=>"CANADA"
		,fr=>"CANADA"
		,de=>"KANADA"
		,es=>"CANADÁ"
		,it=>"CANADA"
		,pt=>"CANADÁ"
		,ru=>"КАНАДА"
		,zh=>"加拿大"
		]);}
	public static function txtCountry_CC(){ return Lemma::txt([__FUNCTION__
		,en=>"COCOS (KEELING) ISLANDS"
		,fr=>"COCOS (KEELING), ÎLES"
		,de=>"COCOS (KEELING) INSELN"
		,es=>"COCOS (KEELING), ISLAS"
		,it=>"ISOLE COCOS (KEELING)"
		,pt=>"ILHAS COCOS (KEELING)"
		,ru=>"КОКОСОВЫЕ (КИЛИНГ) О-ВА"
		,zh=>"科科斯（基林）群岛"
		]);}
	public static function txtCountry_CD(){ return Lemma::txt([__FUNCTION__
		,en=>"CONGO, THE DEMOCRATIC REPUBLIC OF THE"
		,fr=>"CONGO, LA RÉPUBLIQUE DÉMOCRATIQUE DU"
		,de=>"KONGO, DEMOKRATISCHE REPUBLIK"
		,es=>"CONGO, REPÚBLICA DEMOCRÁTICA DEL"
		,it=>"REPUBBLICA DEMOCRATICA DEL CONGO"
		,pt=>"CONGO, A REPÚBLICA DEMOCRÁTICA DO CONGO"
		,ru=>"ДЕМОКРАТИЧЕСКАЯ РЕСПУБЛИКА КОНГО"
		,zh=>"刚果民主共和国"
		]);}
	public static function txtCountry_CF(){ return Lemma::txt([__FUNCTION__
		,en=>"CENTRAL AFRICAN REPUBLIC"
		,fr=>"CENTRAFRICAINE, RÉPUBLIQUE"
		,de=>"ZENTRALAFRIKANISCHE REPUBLIK"
		,es=>"CENTROAFRICANA, REPÚBLICA"
		,it=>"REPUBBLICA CENTRAFRICANA"
		,pt=>"REPÚBLICA CENTRO-AFRICANA"
		,ru=>"ЦЕНТРАЛЬНОАФРИКАНСКАЯ РЕСПУБЛИКА"
		,zh=>"中非共和国"
		]);}
	public static function txtCountry_CG(){ return Lemma::txt([__FUNCTION__
		,en=>"CONGO"
		,fr=>"CONGO"
		,de=>"KONGO"
		,es=>"CONGO"
		,it=>"CONGO"
		,pt=>"CONGO"
		,ru=>"КОНГО"
		,zh=>"刚果"
		]);}
	public static function txtCountry_CH(){ return Lemma::txt([__FUNCTION__
		,en=>"SWITZERLAND"
		,fr=>"SUISSE"
		,de=>"SCHWEIZ"
		,es=>"SUIZA"
		,it=>"SVIZZERA"
		,pt=>"SUÍÇA"
		,ru=>"ШВЕЙЦАРИЯ"
		,zh=>"瑞士"
		]);}
	public static function txtCountry_CI(){ return Lemma::txt([__FUNCTION__
		,en=>"CÔTE D'IVOIRE"
		,fr=>"CÔTE D'IVOIRE"
		,de=>"ELFENBEINKÜSTE"
		,es=>"COSTA DE MARFIL"
		,it=>"COSTA D'AVORIO"
		,pt=>"COSTA DO MARFIM"
		,ru=>"КОТ-Д'ИВУАР"
		,zh=>"科特迪瓦"
		]);}
	public static function txtCountry_CK(){ return Lemma::txt([__FUNCTION__
		,en=>"COOK ISLANDS"
		,fr=>"COOK, ÎLES"
		,de=>"COOK-INSELN"
		,es=>"COOK, ISLAS"
		,it=>"ISOLE COOK"
		,pt=>"ILHAS COOK"
		,ru=>"О-ВА КУКА"
		,zh=>"库克群岛"
		]);}
	public static function txtCountry_CL(){ return Lemma::txt([__FUNCTION__
		,en=>"CHILE"
		,fr=>"CHILI"
		,de=>"CHILE"
		,es=>"CHILE"
		,it=>"CILE"
		,pt=>"CHILE"
		,ru=>"ЧИЛИ"
		,zh=>"智利"
		]);}
	public static function txtCountry_CM(){ return Lemma::txt([__FUNCTION__
		,en=>"CAMEROON"
		,fr=>"CAMEROUN"
		,de=>"KAMERUN"
		,es=>"CAMERÚN"
		,it=>"CAMERUN"
		,pt=>"CAMARÕES"
		,ru=>"КАМЕРУН"
		,zh=>"喀麦隆"
		]);}
	public static function txtCountry_CN(){ return Lemma::txt([__FUNCTION__
		,en=>"CHINA"
		,fr=>"CHINE"
		,de=>"CHINA"
		,es=>"CHINA"
		,it=>"CINA"
		,pt=>"CHINA"
		,ru=>"КИТАЙ"
		,zh=>"中国"
		]);}
	public static function txtCountry_CO(){ return Lemma::txt([__FUNCTION__
		,en=>"COLOMBIA"
		,fr=>"COLOMBIE"
		,de=>"KOLUMBIEN"
		,es=>"COLOMBIA"
		,it=>"COLOMBIA"
		,pt=>"COLÔMBIA"
		,ru=>"КОЛУМБИЯ"
		,zh=>"哥伦比亚"
		]);}
	public static function txtCountry_CR(){ return Lemma::txt([__FUNCTION__
		,en=>"COSTA RICA"
		,fr=>"COSTA RICA"
		,de=>"COSTA RICA"
		,es=>"COSTA RICA"
		,it=>"COSTA RICA"
		,pt=>"COSTA RICA"
		,ru=>"КОСТА-РИКА"
		,zh=>"哥斯达黎加"
		]);}
	public static function txtCountry_CU(){ return Lemma::txt([__FUNCTION__
		,en=>"CUBA"
		,fr=>"CUBA"
		,de=>"KUBA"
		,es=>"CUBA"
		,it=>"CUBA"
		,pt=>"CUBA"
		,ru=>"КУБА"
		,zh=>"古巴"
		]);}
	public static function txtCountry_CV(){ return Lemma::txt([__FUNCTION__
		,en=>"CAPE VERDE"
		,fr=>"CAP-VERT"
		,de=>"KAP VERDE"
		,es=>"CABO VERDE"
		,it=>"CAPO VERDE"
		,pt=>"CABO VERDE"
		,ru=>"О-ВА ЗЕЛЕНОГО МЫСА"
		,zh=>"佛得角"
		]);}
	public static function txtCountry_CW(){ return Lemma::txt([__FUNCTION__
		,en=>"CURAÇAO"
		,fr=>"CURAÇAO"
		,de=>"CURAÇAO"
		,es=>"CURASAO"
		,it=>"CURAÇAO"
		,pt=>"CURAÇAO"
		,ru=>"КЮРАСАО"
		,zh=>"库拉索岛"
		]);}
	public static function txtCountry_CX(){ return Lemma::txt([__FUNCTION__
		,en=>"CHRISTMAS ISLAND"
		,fr=>"CHRISTMAS, ÎLE"
		,de=>"WEIHNACHTSINSEL"
		,es=>"CHRISTMAS, ISLA"
		,it=>"ISOLA DEL NATALE"
		,pt=>"ILHA DE NATAL"
		,ru=>"О. РОЖДЕСТВА"
		,zh=>"圣诞岛"
		]);}
	public static function txtCountry_CY(){ return Lemma::txt([__FUNCTION__
		,en=>"CYPRUS"
		,fr=>"CHYPRE"
		,de=>"ZYPERN"
		,es=>"CHIPRE"
		,it=>"CIPRO"
		,pt=>"CHIPRE"
		,ru=>"КИПР"
		,zh=>"塞浦路斯"
		]);}
	public static function txtCountry_CZ(){ return Lemma::txt([__FUNCTION__
		,en=>"CZECH REPUBLIC"
		,fr=>"TCHÈQUE, RÉPUBLIQUE"
		,de=>"TSCHECHISCHE REPUBLIK"
		,es=>"CHECA, REÚBLICA"
		,it=>"REPUBBLICA CECA"
		,pt=>"REPÚBLICA TCHECA"
		,ru=>"ЧЕШСКАЯ РЕСПУБЛИКА"
		,zh=>"捷克共和国"
		]);}
	public static function txtCountry_DE(){ return Lemma::txt([__FUNCTION__
		,en=>"GERMANY"
		,fr=>"ALLEMAGNE"
		,de=>"DEUTSCHLAND"
		,es=>"ALEMANIA"
		,it=>"GERMANIA"
		,pt=>"ALEMANHA"
		,ru=>"ГЕРМАНИЯ"
		,zh=>"德国"
		]);}
	public static function txtCountry_DJ(){ return Lemma::txt([__FUNCTION__
		,en=>"DJIBOUTI"
		,fr=>"DJIBOUTI"
		,de=>"DSCHIBUTI"
		,es=>"DJIBOUTI"
		,it=>"GIBUTI"
		,pt=>"DJIBUTI"
		,ru=>"ДЖИБУТИ"
		,zh=>"吉布提"
		]);}
	public static function txtCountry_DK(){ return Lemma::txt([__FUNCTION__
		,en=>"DENMARK"
		,fr=>"DANEMARK"
		,de=>"DÄNEMARK"
		,es=>"DINAMARCA"
		,it=>"DANIMARCA"
		,pt=>"DINAMARCA"
		,ru=>"ДАНИЯ"
		,zh=>"丹麦"
		]);}
	public static function txtCountry_DM(){ return Lemma::txt([__FUNCTION__
		,en=>"DOMINICA"
		,fr=>"DOMINIQUE"
		,de=>"DOMINICA"
		,es=>"DOMINICA"
		,it=>"DOMINÌCA"
		,pt=>"DOMINICA"
		,ru=>"ДОМИНИКА"
		,zh=>"多米尼加"
		]);}
	public static function txtCountry_DO(){ return Lemma::txt([__FUNCTION__
		,en=>"DOMINICAN REPUBLIC"
		,fr=>"DOMINICAINE, RÉPUBLIQUE"
		,de=>"DOMINIKANISCHE REPUBLIK"
		,es=>"DOMINICANA, REPÚBLICA"
		,it=>"REPUBBLICA DOMINICANA"
		,pt=>"REPÚBLICA DOMINICANA"
		,ru=>"ДОМИНИКАНСКАЯ РЕСПУБЛИКА"
		,zh=>"多米尼加共和国"
		]);}
	public static function txtCountry_DZ(){ return Lemma::txt([__FUNCTION__
		,en=>"ALGERIA"
		,fr=>"ALGÉRIE"
		,de=>"ALGERIEN"
		,es=>"ARGELIA"
		,it=>"ALGERIA"
		,pt=>"ARGÉLIA"
		,ru=>"АЛЖИР"
		,zh=>"阿尔及利亚"
		]);}
	public static function txtCountry_EC(){ return Lemma::txt([__FUNCTION__
		,en=>"ECUADOR"
		,fr=>"ÉQUATEUR"
		,de=>"ECUADOR"
		,es=>"ECUADOR"
		,it=>"EQUADOR"
		,pt=>"EQUADOR"
		,ru=>"ЭКВАДОР"
		,zh=>"厄瓜多尔"
		]);}
	public static function txtCountry_EE(){ return Lemma::txt([__FUNCTION__
		,en=>"ESTONIA"
		,fr=>"ESTONIE"
		,de=>"ESTONIEN"
		,es=>"ESTONIA"
		,it=>"ESTONIA"
		,pt=>"ESTÔNIA"
		,ru=>"ЭСТОНИЯ"
		,zh=>"爱沙尼亚"
		]);}
	public static function txtCountry_EG(){ return Lemma::txt([__FUNCTION__
		,en=>"EGYPT"
		,fr=>"ÉGYPTE"
		,de=>"ÄGYPTEN"
		,es=>"EGIPTO"
		,it=>"EGITTO"
		,pt=>"EGITO"
		,ru=>"ЕГИПЕТ"
		,zh=>"埃及"
		]);}
	public static function txtCountry_EH(){ return Lemma::txt([__FUNCTION__
		,en=>"WESTERN SAHARA"
		,fr=>"SAHARA OCCIDENTAL"
		,de=>"WESTSAHARA"
		,es=>"SÁHARA OCCIDENTAL"
		,it=>"SAHARA OCCIDENTALE"
		,pt=>"SAARA OCIDENTAL"
		,ru=>"ЗАПАДНАЯ САХАРА"
		,zh=>"西撒哈拉"
		]);}
	public static function txtCountry_ER(){ return Lemma::txt([__FUNCTION__
		,en=>"ERITREA"
		,fr=>"ÉRYTHRÉE"
		,de=>"ERITREA"
		,es=>"ERITREA"
		,it=>"ERITREA"
		,pt=>"ERITREIA "
		,ru=>"ЭРИТРЕЯ"
		,zh=>"厄立特里亚"
		]);}
	public static function txtCountry_ES(){ return Lemma::txt([__FUNCTION__
		,en=>"SPAIN"
		,fr=>"ESPAGNE"
		,de=>"SPANIEN"
		,es=>"ESPAÑA"
		,it=>"SPAGNA"
		,pt=>"ESPANHA"
		,ru=>"ИСПАНИЯ"
		,zh=>"西班牙"
		]);}
	public static function txtCountry_ET(){ return Lemma::txt([__FUNCTION__
		,en=>"ETHIOPIA"
		,fr=>"ÉTHIOPIE"
		,de=>"ÄTHIOPIEN"
		,es=>"ETIOPÍA"
		,it=>"ETIOPIA"
		,pt=>"ETIÓPIA"
		,ru=>"ЭФИОПИЯ"
		,zh=>"埃塞俄比亚"
		]);}
	public static function txtCountry_FI(){ return Lemma::txt([__FUNCTION__
		,en=>"FINLAND"
		,fr=>"FINLANDE"
		,de=>"FINNLAND"
		,es=>"FINLANDIA"
		,it=>"FINLANDIA"
		,pt=>"FINLÂNDIA"
		,ru=>"ФИНЛЯНДИЯ"
		,zh=>"芬兰"
		]);}
	public static function txtCountry_FJ(){ return Lemma::txt([__FUNCTION__
		,en=>"FIJI"
		,fr=>"FIDJI"
		,de=>"FIDJI"
		,es=>"FIYI"
		,it=>"FIJI"
		,pt=>"FIJI"
		,ru=>"ФИДЖИ"
		,zh=>"斐济"
		]);}
	public static function txtCountry_FK(){ return Lemma::txt([__FUNCTION__
		,en=>"FALKLAND ISLANDS (MALVINAS)"
		,fr=>"FALKLAND, ÎLES (MALVINAS)"
		,de=>"FALKLANDINSELN (MALVINAS)"
		,es=>"FALKLAND, ISLAS (MALVINAS)"
		,it=>"ISOLE FALKLAND (MALVINE)"
		,pt=>"ILHAS FALKLAND (MALVINAS)"
		,ru=>"ФОЛКЛЕНДСКИЕ (МАЛЬВИНСКИЕ) О-ВА"
		,zh=>"福克兰群岛（玛尔维娜斯）"
		]);}
	public static function txtCountry_FM(){ return Lemma::txt([__FUNCTION__
		,en=>"MICRONESIA, FEDERATED STATES OF"
		,fr=>"MICRONÉSIE, ÉTATS FÉDÉRÉS DE"
		,de=>"MIKRONESIEN, FÖDERIERTE STAATEN VON "
		,es=>"MICRONESIA, ESTADOS FEDERADOS DE"
		,it=>"STATI FEDERATI DI MICRONESIA"
		,pt=>"MICRONÉSIA, ESTADOS FEDERADOS DA"
		,ru=>"ФЕДЕРАТИВНЫЕ ШТАТЫ МИКРОНЕЗИИ"
		,zh=>"密克罗尼西亚联邦"
		]);}
	public static function txtCountry_FO(){ return Lemma::txt([__FUNCTION__
		,en=>"FAROE ISLANDS"
		,fr=>"FÉROÉ, ÎLES"
		,de=>"Färöer"
		,es=>"FEROE, ISLAS"
		,it=>"ISOLE FAROE"
		,pt=>"ILHAS FAROÉ"
		,ru=>"ФАРЕРСКИЕ О-ВА"
		,zh=>"法罗群岛"
		]);}
	public static function txtCountry_FR(){ return Lemma::txt([__FUNCTION__
		,en=>"FRANCE"
		,fr=>"FRANCE"
		,de=>"FRANKREICH"
		,es=>"FRANCIA"
		,it=>"FRANCIA"
		,pt=>"FRANÇA"
		,ru=>"ФРАНЦИЯ"
		,zh=>"法国"
		]);}
	public static function txtCountry_GA(){ return Lemma::txt([__FUNCTION__
		,en=>"GABON"
		,fr=>"GABON"
		,de=>"GABUN"
		,es=>"GABÓN"
		,it=>"GABON"
		,pt=>"GABÃO"
		,ru=>"ГАБОН"
		,zh=>"加蓬"
		]);}
	public static function txtCountry_GB(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED KINGDOM"
		,fr=>"ROYAUME-UNI"
		,de=>"VEREINIGTES KÖNIGREICH"
		,es=>"REINO UNIDO"
		,it=>"REGNO UNITO"
		,pt=>"REINO UNIDO"
		,ru=>"ВЕЛИКОБРИТАНИЯ"
		,zh=>"英国"
		]);}
	public static function txtCountry_GD(){ return Lemma::txt([__FUNCTION__
		,en=>"GRENADA"
		,fr=>"GRENADE"
		,de=>"FÄRÖER"
		,es=>"GRANADA"
		,it=>"GRENADA"
		,pt=>"GRANADA"
		,ru=>"ГРЕНАДА"
		,zh=>"格林纳达"
		]);}
	public static function txtCountry_GE(){ return Lemma::txt([__FUNCTION__
		,en=>"GEORGIA"
		,fr=>"GÉORGIE"
		,de=>"GEORGIEN"
		,es=>"GEORGIA"
		,it=>"GEORGIA"
		,pt=>"GEÓRGIA"
		,ru=>"ГРУЗИЯ"
		,zh=>"格鲁吉亚"
		]);}
	public static function txtCountry_GF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH GUIANA"
		,fr=>"GUYANE FRANÇAISE"
		,de=>"FRANZÖSISCH GUINEA"
		,es=>"GUYANA FRANCESA"
		,it=>"GUYANA FRANCESE"
		,pt=>"GUIANA FRANCESA"
		,ru=>"ФРАНЦУЗСКАЯ ГВИАНА"
		,zh=>"法属圭亚那"
		]);}
	public static function txtCountry_GG(){ return Lemma::txt([__FUNCTION__
		,en=>"GUERNSEY"
		,fr=>"GUERNESEY"
		,de=>"GUERNSEY"
		,es=>"GUERNSEY"
		,it=>"GUERNSEY"
		,pt=>"GUERNSEY"
		,ru=>"ГЕРНСИ"
		,zh=>"格恩西岛"
		]);}
	public static function txtCountry_GH(){ return Lemma::txt([__FUNCTION__
		,en=>"GHANA"
		,fr=>"GHANA"
		,de=>"GHANA"
		,es=>"GHANA"
		,it=>"GHANA"
		,pt=>"GANA"
		,ru=>"ГАНА"
		,zh=>"加纳"
		]);}
	public static function txtCountry_GI(){ return Lemma::txt([__FUNCTION__
		,en=>"GIBRALTAR"
		,fr=>"GIBRALTAR"
		,de=>"GIBRALTAR"
		,es=>"GIBRALTAR"
		,it=>"GIBILTERRA"
		,pt=>"GIBRALTAR"
		,ru=>"ГИБРАЛТАР"
		,zh=>"直布罗陀"
		]);}
	public static function txtCountry_GL(){ return Lemma::txt([__FUNCTION__
		,en=>"GREENLAND"
		,fr=>"GROENLAND"
		,de=>"GRÖNLAND"
		,es=>"GROENLANDIA"
		,it=>"GROENLANDIA"
		,pt=>"GROENLÂNDIA"
		,ru=>"ГРЕНЛАНДИЯ"
		,zh=>"格陵兰"
		]);}
	public static function txtCountry_GM(){ return Lemma::txt([__FUNCTION__
		,en=>"GAMBIA"
		,fr=>"GAMBIE"
		,de=>"GAMBIA"
		,es=>"GAMBIA"
		,it=>"GAMBIA"
		,pt=>"GÂMBIA"
		,ru=>"ГАМБИЯ"
		,zh=>"冈比亚"
		]);}
	public static function txtCountry_GN(){ return Lemma::txt([__FUNCTION__
		,en=>"GUINEA"
		,fr=>"GUINÉE"
		,de=>"GUINEA"
		,es=>"GUINEA"
		,it=>"GUINEA"
		,pt=>"GUINÉ"
		,ru=>"ГВИНЕЯ"
		,zh=>"几内亚"
		]);}
	public static function txtCountry_GP(){ return Lemma::txt([__FUNCTION__
		,en=>"GUADELOUPE"
		,fr=>"GUADELOUPE"
		,de=>"GUADALOUPE"
		,es=>"GUADALUPE"
		,it=>"GUADELUPE"
		,pt=>"GUADALUPE"
		,ru=>"ГВАДЕЛУПА"
		,zh=>"瓜德罗普岛"
		]);}
	public static function txtCountry_GQ(){ return Lemma::txt([__FUNCTION__
		,en=>"EQUATORIAL GUINEA"
		,fr=>"GUINÉE ÉQUATORIALE"
		,de=>"ÄQUATORIAL GUINEA"
		,es=>"GUINEA ECUATORIAL"
		,it=>"GUINEA EQUATORIALE"
		,pt=>"GUINÉ EQUATORIAL"
		,ru=>"ЭКВАТОРИАЛЬНАЯ ГВИНЕЯ"
		,zh=>"赤道几内亚"
		]);}
	public static function txtCountry_GR(){ return Lemma::txt([__FUNCTION__
		,en=>"GREECE"
		,fr=>"GRÈCE"
		,de=>"GRIECHENLAND"
		,es=>"GRECIA"
		,it=>"GRECIA"
		,pt=>"GRÉCIA"
		,ru=>"ГРЕЦИЯ"
		,zh=>"希腊"
		]);}
	public static function txtCountry_GS(){ return Lemma::txt([__FUNCTION__
		,en=>"SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS"
		,fr=>"GÉORGIE DU SUD ET LES ÎLES SANDWICH DU SUD"
		,de=>"SÜD-GEORGIEN UND SÜDLICHE SANDWICHINSELN"
		,es=>"GEORGIAS DEL SUR Y SANDWICH, ISLAS"
		,it=>"GEORGIA DEL SUD E LE ISOLE SANDWICH DEL SUD"
		,pt=>"ILHAS GEÓRGIA DO SUL E SANDUÍCHE DO SUL"
		,ru=>"ЮЖНАЯ ДЖОРДЖИЯ И ЮЖНЫЕ САНДВИЧЕВЫ ОСТРОВА"
		,zh=>"南乔治亚岛和南桑威奇群岛"
		]);}
	public static function txtCountry_GT(){ return Lemma::txt([__FUNCTION__
		,en=>"GUATEMALA"
		,fr=>"GUATEMALA"
		,de=>"GUATEMALA"
		,es=>"GUATEMALA"
		,it=>"GUATEMALA"
		,pt=>"GUATEMALA"
		,ru=>"ГВАТЕМАЛА"
		,zh=>"危地马拉"
		]);}
	public static function txtCountry_GU(){ return Lemma::txt([__FUNCTION__
		,en=>"GUAM"
		,fr=>"GUAM"
		,de=>"GUAM"
		,es=>"GUAM"
		,it=>"GUAM"
		,pt=>"GUAM"
		,ru=>"ГУАМ"
		,zh=>"关岛"
		]);}
	public static function txtCountry_GW(){ return Lemma::txt([__FUNCTION__
		,en=>"GUINEA-BISSAU"
		,fr=>"GUINÉE-BISSAU"
		,de=>"GUINEA-BISSAU"
		,es=>"GUINEA BISÁU"
		,it=>"GUINEA BISSAU"
		,pt=>"GUINÉ-BISSAU"
		,ru=>"ГВИНЕЯ-БИСАУ"
		,zh=>"几内亚比绍"
		]);}
	public static function txtCountry_GY(){ return Lemma::txt([__FUNCTION__
		,en=>"GUYANA"
		,fr=>"GUYANA"
		,de=>"GUYANA"
		,es=>"GUYANA"
		,it=>"GUYANA"
		,pt=>"GUIANA"
		,ru=>"ГАЙАНА"
		,zh=>"圭亚那"
		]);}
	public static function txtCountry_HK(){ return Lemma::txt([__FUNCTION__
		,en=>"HONG KONG"
		,fr=>"HONG-KONG"
		,de=>"HONG-KONG"
		,es=>"HONG KONG"
		,it=>"HONG KONG"
		,pt=>"HONG KONG"
		,ru=>"ГОНКОНГ"
		,zh=>"香港"
		]);}
	public static function txtCountry_HM(){ return Lemma::txt([__FUNCTION__
		,en=>"HEARD ISLAND AND MCDONALD ISLANDS"
		,fr=>"HEARD, ÎLE ET MCDONALD, ÎLES"
		,de=>"HEARD INSEL UND MC DONALD INSELN"
		,es=>"HEARD Y MCDONAL, ISLAS"
		,it=>"ISOLE HEARD E MCDONALD"
		,pt=>"ILHA HEARD E ILHAS MCDONALD"
		,ru=>"О-ВА ХЕРД И МАКДОНАЛЬД"
		,zh=>"赫德岛和麦克唐纳群岛"
		]);}
	public static function txtCountry_HN(){ return Lemma::txt([__FUNCTION__
		,en=>"HONDURAS"
		,fr=>"HONDURAS"
		,de=>"HONDURAS"
		,es=>"HONDURAS"
		,it=>"HONDURAS"
		,pt=>"HONDURAS"
		,ru=>"ГОНДУРАС"
		,zh=>"洪都拉斯"
		]);}
	public static function txtCountry_HR(){ return Lemma::txt([__FUNCTION__
		,en=>"CROATIA"
		,fr=>"CROATIE"
		,de=>"KROATIEN"
		,es=>"CROACIA"
		,it=>"CROAZIA"
		,pt=>"CROÁCIA"
		,ru=>"ХОРВАТИЯ"
		,zh=>"克罗地亚"
		]);}
	public static function txtCountry_HT(){ return Lemma::txt([__FUNCTION__
		,en=>"HAITI"
		,fr=>"HAÏTI"
		,de=>"HAITI"
		,es=>"HAITÍ"
		,it=>"HAITI"
		,pt=>"HAITI"
		,ru=>"ГАИТИ"
		,zh=>"海地"
		]);}
	public static function txtCountry_HU(){ return Lemma::txt([__FUNCTION__
		,en=>"HUNGARY"
		,fr=>"HONGRIE"
		,de=>"UNGARN"
		,es=>"HUNGRÍA"
		,it=>"UNGHERIA"
		,pt=>"HUNGRIA"
		,ru=>"ВЕНГРИЯ"
		,zh=>"匈牙利"
		]);}
	public static function txtCountry_ID(){ return Lemma::txt([__FUNCTION__
		,en=>"INDONESIA"
		,fr=>"INDONÉSIE"
		,de=>"INDONESIEN"
		,es=>"INDONESIA"
		,it=>"INDONESIA"
		,pt=>"INDONÉSIA"
		,ru=>"ИНДОНЕЗИЯ"
		,zh=>"印度尼西亚"
		]);}
	public static function txtCountry_IE(){ return Lemma::txt([__FUNCTION__
		,en=>"IRELAND"
		,fr=>"IRLANDE"
		,de=>"IRLAND"
		,es=>"IRLANDA"
		,it=>"IRLANDA"
		,pt=>"IRLANDA"
		,ru=>"ИРЛАНДИЯ"
		,zh=>"爱尔兰"
		]);}
	public static function txtCountry_IL(){ return Lemma::txt([__FUNCTION__
		,en=>"ISRAEL"
		,fr=>"ISRAËL"
		,de=>"ISRAEL"
		,es=>"ISRAEL"
		,it=>"ISRAELE"
		,pt=>"ISRAEL"
		,ru=>"ИЗРАИЛЬ"
		,zh=>"以色列"
		]);}
	public static function txtCountry_IM(){ return Lemma::txt([__FUNCTION__
		,en=>"ISLE OF MAN"
		,fr=>"ÎLE DE MAN"
		,de=>"ISLE OF MAN"
		,es=>"ISLA DE MAN"
		,it=>"ISOLA DI MAN"
		,pt=>"ILHA DE MAN"
		,ru=>"О. МЭН"
		,zh=>"马恩岛"
		]);}
	public static function txtCountry_IN(){ return Lemma::txt([__FUNCTION__
		,en=>"INDIA"
		,fr=>"INDE"
		,de=>"INDIEN"
		,es=>"INDIA"
		,it=>"INDIA"
		,pt=>"ÍNDIA"
		,ru=>"ИНДИЯ"
		,zh=>"印度"
		]);}
	public static function txtCountry_IO(){ return Lemma::txt([__FUNCTION__
		,en=>"BRITISH INDIAN OCEAN TERRITORY"
		,fr=>"OCÉAN INDIEN, TERRITOIRE BRITANNIQUE DE L"
		,de=>"BRITISCHES TERRITORIUM IM INDISCHEN OZEAN"
		,es=>"OCÉANO ÍNDICO, TERRITORIO BRITÁNICO DEL"
		,it=>"TERRITORIO BRITANNICO DELL'OCEANO INDIANO"
		,pt=>"TERRITÓRIO BRITÂNICO DO OCEANO ÍNDICO"
		,ru=>"БРИТАНСКИЕ ТЕРРИТОРИИ В ИНДИЙСКОМ ОКЕАНЕ"
		,zh=>"英属印度洋领地"
		]);}
	public static function txtCountry_IQ(){ return Lemma::txt([__FUNCTION__
		,en=>"IRAQ"
		,fr=>"IRAQ"
		,de=>"IRAK"
		,es=>"IRAK"
		,it=>"IRAQ"
		,pt=>"IRAQUE"
		,ru=>"ИРАК"
		,zh=>"伊拉克"
		]);}
	public static function txtCountry_IR(){ return Lemma::txt([__FUNCTION__
		,en=>"IRAN, ISLAMIC REPUBLIC OF"
		,fr=>"IRAN, RÉPUBLIQUE ISLAMIQUE D"
		,de=>"IRAN, ISLAMISCHE REPUBLIK"
		,es=>"IRÁN, REPÚBLICA ISLÁMICA DE"
		,it=>"IRAN"
		,pt=>"IRÃ, REPÚBLICA ISLÂMICA DO"
		,ru=>"ИСЛАМСКАЯ РЕСПУБЛИКА ИРАН"
		,zh=>"伊朗伊斯兰共和国"
		]);}
	public static function txtCountry_IS(){ return Lemma::txt([__FUNCTION__
		,en=>"ICELAND"
		,fr=>"ISLANDE"
		,de=>"ISLAND"
		,es=>"ISLANDIA"
		,it=>"ISLANDA"
		,pt=>"ISLÂNDIA"
		,ru=>"ИСЛАНДИЯ"
		,zh=>"冰岛"
		]);}
	public static function txtCountry_IT(){ return Lemma::txt([__FUNCTION__
		,en=>"ITALY"
		,fr=>"ITALIE"
		,de=>"ITALIEN"
		,es=>"ITALIA"
		,it=>"ITALIA"
		,pt=>"ITÁLIA"
		,ru=>"ИТАЛИЯ"
		,zh=>"意大利"
		]);}
	public static function txtCountry_JE(){ return Lemma::txt([__FUNCTION__
		,en=>"JERSEY"
		,fr=>"JERSEY"
		,de=>"JERSEY"
		,es=>"JERSEY"
		,it=>"JERSEY"
		,pt=>"JERSEY"
		,ru=>"ДЖЕРСИ"
		,zh=>"泽西岛"
		]);}
	public static function txtCountry_JM(){ return Lemma::txt([__FUNCTION__
		,en=>"JAMAICA"
		,fr=>"JAMAÏQUE"
		,de=>"JAMAIKA"
		,es=>"JAMAICA"
		,it=>"GIAMAICA"
		,pt=>"JAMAICA"
		,ru=>"ЯМАЙКА"
		,zh=>"牙买加"
		]);}
	public static function txtCountry_JO(){ return Lemma::txt([__FUNCTION__
		,en=>"JORDAN"
		,fr=>"JORDANIE"
		,de=>"JORDANIEN"
		,es=>"JORDANIA"
		,it=>"GIORDANIA"
		,pt=>"JORDÂNIA"
		,ru=>"ИОРДАНИЯ"
		,zh=>"约旦"
		]);}
	public static function txtCountry_JP(){ return Lemma::txt([__FUNCTION__
		,en=>"JAPAN"
		,fr=>"JAPON"
		,de=>"JAPAN"
		,es=>"JAPÓN"
		,it=>"GIAPPONE"
		,pt=>"JAPÃO"
		,ru=>"ЯПОНИЯ"
		,zh=>"日本"
		]);}
	public static function txtCountry_KE(){ return Lemma::txt([__FUNCTION__
		,en=>"KENYA"
		,fr=>"KENYA"
		,de=>"KENIA"
		,es=>"KENIA"
		,it=>"KENYA"
		,pt=>"QUÊNIA"
		,ru=>"КЕНИЯ"
		,zh=>"肯尼亚"
		]);}
	public static function txtCountry_KG(){ return Lemma::txt([__FUNCTION__
		,en=>"KYRGYZSTAN"
		,fr=>"KIRGHIZISTAN"
		,de=>"KIRGHISTAN"
		,es=>"KISRGUISTÁN"
		,it=>"KIRGHIZISTAN"
		,pt=>"QUIRGUISTÃO"
		,ru=>"КИРГИЗИЯ"
		,zh=>"吉尔吉斯斯坦"
		]);}
	public static function txtCountry_KH(){ return Lemma::txt([__FUNCTION__
		,en=>"CAMBODIA"
		,fr=>"CAMBODGE"
		,de=>"KAMBODIA"
		,es=>"CAMBODIA"
		,it=>"CAMBOGIA"
		,pt=>"CAMBOJA"
		,ru=>"КАМБОДЖА"
		,zh=>"柬埔寨"
		]);}
	public static function txtCountry_KI(){ return Lemma::txt([__FUNCTION__
		,en=>"KIRIBATI"
		,fr=>"KIRIBATI"
		,de=>"KIRIBATI"
		,es=>"KIRIBATI"
		,it=>"KIRIABATI"
		,pt=>"QUIRIBATI"
		,ru=>"КИРИБАТИ"
		,zh=>"基里巴斯"
		]);}
	public static function txtCountry_KM(){ return Lemma::txt([__FUNCTION__
		,en=>"COMOROS"
		,fr=>"COMORES"
		,de=>"KOMOREN"
		,es=>"COMORAS"
		,it=>"COMORE"
		,pt=>"COMORES"
		,ru=>"КОМОРСКИЕ ОСТРОВА"
		,zh=>"科摩罗"
		]);}
	public static function txtCountry_KN(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT KITTS AND NEVIS"
		,fr=>"SAINT-KITTS-ET-NEVIS"
		,de=>"SAINT KITTS UND NEVIS"
		,es=>"SAN KITTS Y NEVIS"
		,it=>"SAINT KITTS E NEVIS"
		,pt=>"SÃO CRISTÓVÃO E NEVES"
		,ru=>"СЕНТ-КИТС И НЕВИС"
		,zh=>"圣基茨和尼维斯"
		]);}
	public static function txtCountry_KP(){ return Lemma::txt([__FUNCTION__
		,en=>"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF"
		,fr=>"CORÉE, RÉPUBLIQUE POPULAIRE DÉMOCRATIQUE DE"
		,de=>"KOREA, DEMOKRATISCHE VOLKSREPUBLIK VON"
		,es=>"COREA, REPÚBLICA DEMOCRÁTICA POPULAR DE"
		,it=>"COREA DEL NORD"
		,pt=>"COREIA, REPÚBLICA DEMOCRÁTICA DA"
		,ru=>"КОРЕЙСКАЯ НАРОДНО-ДЕМОКРАТИЧЕСКАЯ РЕСПУБЛИКА"
		,zh=>"朝鲜民主主义人民共和国"
		]);}
	public static function txtCountry_KR(){ return Lemma::txt([__FUNCTION__
		,en=>"KOREA, REPUBLIC OF"
		,fr=>"CORÉE, RÉPUBLIQUE DE"
		,de=>"KOREA, REPUBLIK VON"
		,es=>"COREA, REPÚBLICA DE"
		,it=>"COREA DEL SUD"
		,pt=>"COREIA, REPÚBLICA DA"
		,ru=>"РЕСПУБЛИКА КОРЕЯ "
		,zh=>"大韩民国"
		]);}
	public static function txtCountry_KW(){ return Lemma::txt([__FUNCTION__
		,en=>"KUWAIT"
		,fr=>"KOWEÏT"
		,de=>"KUWAIT"
		,es=>"KUWAIT"
		,it=>"KUWAIT"
		,pt=>"KUWAIT"
		,ru=>"КУВЕЙТ"
		,zh=>"科威特"
		]);}
	public static function txtCountry_KY(){ return Lemma::txt([__FUNCTION__
		,en=>"CAYMAN ISLANDS"
		,fr=>"CAÏMANES, ÎLES"
		,de=>"CAYMAN INSELN"
		,es=>"CAIMÁN, ISLAS"
		,it=>"ISOLE CAYMAN"
		,pt=>"ILHAS CAIMÃ"
		,ru=>"КАЙМАНОВЫ ОСТРОВА"
		,zh=>"开曼群岛"
		]);}
	public static function txtCountry_KZ(){ return Lemma::txt([__FUNCTION__
		,en=>"KAZAKHSTAN"
		,fr=>"KAZAKHSTAN"
		,de=>"Kasachstan "
		,es=>"KAZAJISTÁN"
		,it=>"KAZAKISTAN"
		,pt=>"CAZAQUISTÃO"
		,ru=>"КАЗАХСТАН"
		,zh=>"哈萨克斯坦"
		]);}
	public static function txtCountry_LA(){ return Lemma::txt([__FUNCTION__
		,en=>"LAO PEOPLE'S DEMOCRATIC REPUBLIC"
		,fr=>"LAO, RÉPUBLIQUE DÉMOCRATIQUE POPULAIRE"
		,de=>"LAOS, DEMOKRATISCHE VOLKSREPUBLIK"
		,es=>"LAO, REPÚBLICA DEMOCRÁTICA POPULAR DE"
		,it=>"LAOS"
		,pt=>"REPÚBLICA DEMOCRÁTICA LAO"
		,ru=>"ЛАОССКАЯ НАРОДНО-ДЕМОКРАТИЧЕСКАЯ РЕСПУБЛИКА"
		,zh=>"老挝人民民主共和国"
		]);}
	public static function txtCountry_LB(){ return Lemma::txt([__FUNCTION__
		,en=>"LEBANON"
		,fr=>"LIBAN"
		,de=>"LIBANON"
		,es=>"LÍBANO"
		,it=>"LIBANO"
		,pt=>"LÍBANO"
		,ru=>"ЛИВАН"
		,zh=>"黎巴嫩"
		]);}
	public static function txtCountry_LC(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT LUCIA"
		,fr=>"SAINTE-LUCIE"
		,de=>"ST. LUCIA"
		,es=>"SANTA LUCÍA"
		,it=>"SANTA LUCIA"
		,pt=>"SANTA LÚCIA"
		,ru=>"СЕНТ-ЛЮСИЯ"
		,zh=>"圣卢西亚"
		]);}
	public static function txtCountry_LI(){ return Lemma::txt([__FUNCTION__
		,en=>"LIECHTENSTEIN"
		,fr=>"LIECHTENSTEIN"
		,de=>"LIECHTENSTEIN"
		,es=>"LIECHTENSTEIN"
		,it=>"LIECHTENSTEIN"
		,pt=>"LIECHTENSTEIN"
		,ru=>"ЛИХТЕНШТЕЙН"
		,zh=>"列支敦斯登"
		]);}
	public static function txtCountry_LK(){ return Lemma::txt([__FUNCTION__
		,en=>"SRI LANKA"
		,fr=>"SRI LANKA"
		,de=>"SRI LANKA"
		,es=>"SRI LANKA"
		,it=>"SRI LANKA"
		,pt=>"SRI LANKA"
		,ru=>"ШРИ-ЛАНКА"
		,zh=>"斯里兰卡"
		]);}
	public static function txtCountry_LR(){ return Lemma::txt([__FUNCTION__
		,en=>"LIBERIA"
		,fr=>"LIBÉRIA"
		,de=>"LIBERIA"
		,es=>"LIBERIA"
		,it=>"LIBERIA"
		,pt=>"LIBÉRIA"
		,ru=>"ЛИБЕРИЯ"
		,zh=>"利比里亚"
		]);}
	public static function txtCountry_LS(){ return Lemma::txt([__FUNCTION__
		,en=>"LESOTHO"
		,fr=>"LESOTHO"
		,de=>"LESOTHO"
		,es=>"LESOTO"
		,it=>"LESOTHO"
		,pt=>"LESOTO"
		,ru=>"ЛЕСОТО"
		,zh=>"莱索托"
		]);}
	public static function txtCountry_LT(){ return Lemma::txt([__FUNCTION__
		,en=>"LITHUANIA"
		,fr=>"LITUANIE"
		,de=>"LITHUANIEN"
		,es=>"LITUANIA"
		,it=>"LITUANIA"
		,pt=>"LITUÂNIA"
		,ru=>"ЛИТВА"
		,zh=>"立陶宛"
		]);}
	public static function txtCountry_LU(){ return Lemma::txt([__FUNCTION__
		,en=>"LUXEMBOURG"
		,fr=>"LUXEMBOURG"
		,de=>"LUXEMBURG"
		,es=>"LUXEMBURGO"
		,it=>"LUSSEMBURGO"
		,pt=>"LUXEMBURGO"
		,ru=>"ЛЮКСЕМБУРГ"
		,zh=>"卢森堡"
		]);}
	public static function txtCountry_LV(){ return Lemma::txt([__FUNCTION__
		,en=>"LATVIA"
		,fr=>"LETTONIE"
		,de=>"LATVIEN"
		,es=>"LETONIA"
		,it=>"LETTONIA"
		,pt=>"LETÔNIA "
		,ru=>"ЛАТВИЯ"
		,zh=>"拉脱维亚"
		]);}
	public static function txtCountry_LY(){ return Lemma::txt([__FUNCTION__
		,en=>"LIBYAN ARAB JAMAHIRIYA"
		,fr=>"LIBYENNE, JAMAHIRIYA ARABE"
		,de=>"LIBYSCH ARABISCHE VOLKS-DSCHMAHIRIJA"
		,es=>"LIBIA"
		,it=>"LIBIA"
		,pt=>"LÍBIA, JAMAHIRIYA ÁRABE"
		,ru=>"ЛИВИЙСКАЯ АРАБСКАЯ ДЖАМАХИРИЯ"
		,zh=>"阿拉伯利比亚民众国"
		]);}
	public static function txtCountry_MA(){ return Lemma::txt([__FUNCTION__
		,en=>"MOROCCO"
		,fr=>"MAROC"
		,de=>"MAROKKO"
		,es=>"MARRUECOS"
		,it=>"MAROCCO"
		,pt=>"MARROCOS"
		,ru=>"МАРОККО"
		,zh=>"摩洛哥"
		]);}
	public static function txtCountry_MC(){ return Lemma::txt([__FUNCTION__
		,en=>"MONACO"
		,fr=>"MONACO"
		,de=>"MONACO"
		,es=>"MÓNACO"
		,it=>"MONACO"
		,pt=>"MÔNACO"
		,ru=>"МОНАКО"
		,zh=>"摩纳哥"
		]);}
	public static function txtCountry_MD(){ return Lemma::txt([__FUNCTION__
		,en=>"MOLDOVA, REPUBLIC OF"
		,fr=>"MOLDOVA, RÉPUBLIQUE DE"
		,de=>"MOLDAVIEN, REPUBLIK VON"
		,es=>"MOLDAVIA, REPÚBLICA DE"
		,it=>"MOLDOVA"
		,pt=>"MOLDÁVIA, REPÚBLICA DA"
		,ru=>"РЕСПУБЛИКА МОЛДОВА"
		,zh=>"摩尔多瓦共和国"
		]);}
	public static function txtCountry_ME(){ return Lemma::txt([__FUNCTION__
		,en=>"MONTENEGRO"
		,fr=>"MONTÉNÉGRO"
		,de=>"MONTENEGRO"
		,es=>"MONTENEGRO"
		,it=>"MONTENEGRO"
		,pt=>"MONTENEGRO"
		,ru=>"ЧЕРНОГОРИЯ"
		,zh=>"黑山共和国"
		]);}
	public static function txtCountry_MF(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT MARTIN (FRENCH PART)"
		,fr=>"SAINT-MARTIN(PARTIE FRANÇAISE)"
		,de=>"ST. MARTIN (FRANZÖSISCHER TEIL)"
		,es=>"SAINT MARTIN (PARTE FRANCESA)"
		,it=>"SAINT MARTIN (PARTE FRANCESE)"
		,pt=>"SÃO MARTINHO (PARTE FRANCESA)"
		,ru=>"СЕН-МАРТЕН (ФРАНЦУЗСКАЯ ЧАСТЬ)"
		,zh=>"圣马丁岛（法属）"
		]);}
	public static function txtCountry_MG(){ return Lemma::txt([__FUNCTION__
		,en=>"MADAGASCAR"
		,fr=>"MADAGASCAR"
		,de=>"MADAGASKAR"
		,es=>"MADAGASCAR"
		,it=>"MADAGASCAR"
		,pt=>"MADAGASCAR "
		,ru=>"МАДАГАСКАР"
		,zh=>"马达加斯加"
		]);}
	public static function txtCountry_MH(){ return Lemma::txt([__FUNCTION__
		,en=>"MARSHALL ISLANDS"
		,fr=>"MARSHALL, ÎLES"
		,de=>"MARSCHALLINSELN"
		,es=>"MARSHALL, ISLAS"
		,it=>"ISOLE MARSHALL"
		,pt=>"ILHAS MARSHALL"
		,ru=>"МАРШАЛЛОВЫ О-ВА"
		,zh=>"马绍尔群岛"
		]);}
	public static function txtCountry_MK(){ return Lemma::txt([__FUNCTION__
		,en=>"MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF"
		,fr=>"MACÉDOINE, L'EX-RÉPUBLIQUE YOUGOSLAVE DE"
		,de=>"MAZEDONIEN, EHEMALIGE JUGOSLAWISCHE REPUBLIK"
		,es=>"MACEDONIA, ANTIGUA REPÚBLICA YUGOSLAVA DE"
		,it=>"MACEDONIA"
		,pt=>"MACEDÔNIA, A ANTIGA REPÚBLICA IUGOSLAVA DA"
		,ru=>"БЫВШАЯ ЮГОСЛАВСКАЯ РЕСПУБЛИКА МАКЕДОНИЯ"
		,zh=>"前南斯拉夫马其顿共和国"
		]);}
	public static function txtCountry_ML(){ return Lemma::txt([__FUNCTION__
		,en=>"MALI"
		,fr=>"MALI"
		,de=>"MALI"
		,es=>"MALI"
		,it=>"MALI"
		,pt=>"MÁLI "
		,ru=>"МАЛИ"
		,zh=>"马里"
		]);}
	public static function txtCountry_MM(){ return Lemma::txt([__FUNCTION__
		,en=>"MYANMAR"
		,fr=>"MYANMAR"
		,de=>"MYANMAR"
		,es=>"MYANMAR"
		,it=>"BIRMANIA"
		,pt=>"MYANMAR (Birmânia)"
		,ru=>"МЬЯНМА"
		,zh=>"缅甸"
		]);}
	public static function txtCountry_MN(){ return Lemma::txt([__FUNCTION__
		,en=>"MONGOLIA"
		,fr=>"MONGOLIE"
		,de=>"MONGOLEI"
		,es=>"MONGOLIA"
		,it=>"MONGOLIA"
		,pt=>"MONGÓLIA"
		,ru=>"МОНГОЛИЯ"
		,zh=>"蒙古"
		]);}
	public static function txtCountry_MO(){ return Lemma::txt([__FUNCTION__
		,en=>"MACAO"
		,fr=>"MACAO"
		,de=>"MACAU"
		,es=>"MACAO"
		,it=>"MACAO"
		,pt=>"MACAU"
		,ru=>"МАКАО"
		,zh=>"澳门"
		]);}
	public static function txtCountry_MP(){ return Lemma::txt([__FUNCTION__
		,en=>"NORTHERN MARIANA ISLANDS"
		,fr=>"MARIANNES DU NORD, ÎLES"
		,de=>"NÖRDLICHE MARIANEN"
		,es=>"MARIANAS DEL NORTE, ISLAS"
		,it=>"ISOLE MARIANNE SETTENTRIONALI"
		,pt=>"ILHAS MARIANAS DO NORTE"
		,ru=>"СЕВЕРНЫЕ МАРИАНСКИЕ О-ВА"
		,zh=>"北马里亚纳群岛"
		]);}
	public static function txtCountry_MQ(){ return Lemma::txt([__FUNCTION__
		,en=>"MARTINIQUE"
		,fr=>"MARTINIQUE"
		,de=>"MARTINIQUE"
		,es=>"MARTINICA"
		,it=>"MARTINICA"
		,pt=>"MARTINICA"
		,ru=>"МАРТИНИКА"
		,zh=>"马提尼克"
		]);}
	public static function txtCountry_MR(){ return Lemma::txt([__FUNCTION__
		,en=>"MAURITANIA"
		,fr=>"MAURITANIE"
		,de=>"MAURETANIEN"
		,es=>"MAURITANIA"
		,it=>"MAURITANIA"
		,pt=>"MAURITÂNIA"
		,ru=>"МАВРИТАНИЯ"
		,zh=>"毛里塔尼亚"
		]);}
	public static function txtCountry_MS(){ return Lemma::txt([__FUNCTION__
		,en=>"MONTSERRAT"
		,fr=>"MONTSERRAT"
		,de=>"MONTSERRAT"
		,es=>"MONSERRAT"
		,it=>"MONTSERRAT"
		,pt=>"MONTSERRAT"
		,ru=>"МОНТСЕРРАТ"
		,zh=>"蒙特塞拉特岛"
		]);}
	public static function txtCountry_MT(){ return Lemma::txt([__FUNCTION__
		,en=>"MALTA"
		,fr=>"MALTE"
		,de=>"MALTA"
		,es=>"MALTA"
		,it=>"MALTA"
		,pt=>"MALTA"
		,ru=>"МАЛЬТА"
		,zh=>"马耳他"
		]);}
	public static function txtCountry_MU(){ return Lemma::txt([__FUNCTION__
		,en=>"MAURITIUS"
		,fr=>"MAURICE"
		,de=>"MAURITIUS"
		,es=>"MAURICIO"
		,it=>"MAURITIUS"
		,pt=>"MAURÍCIA"
		,ru=>"МАВРИКИЙ"
		,zh=>"毛里求斯"
		]);}
	public static function txtCountry_MV(){ return Lemma::txt([__FUNCTION__
		,en=>"MALDIVES"
		,fr=>"MALDIVES"
		,de=>"MALEDIVEN"
		,es=>"MALDIVAS"
		,it=>"MALDIVE"
		,pt=>"MALDIVAS"
		,ru=>"МАЛЬДИВСКИЕ ОСТРОВА"
		,zh=>"马尔代夫"
		]);}
	public static function txtCountry_MW(){ return Lemma::txt([__FUNCTION__
		,en=>"MALAWI"
		,fr=>"MALAWI"
		,de=>"MALAWI"
		,es=>"MALAWI"
		,it=>"MALAWI"
		,pt=>"MALAWI"
		,ru=>"МАЛАВИ"
		,zh=>"马拉维"
		]);}
	public static function txtCountry_MX(){ return Lemma::txt([__FUNCTION__
		,en=>"MEXICO"
		,fr=>"MEXIQUE"
		,de=>"MEXIKO"
		,es=>"MÉXICO"
		,it=>"MESSICO"
		,pt=>"MÉXICO "
		,ru=>"МЕКСИКА"
		,zh=>"墨西哥"
		]);}
	public static function txtCountry_MY(){ return Lemma::txt([__FUNCTION__
		,en=>"MALAYSIA"
		,fr=>"MALAISIE"
		,de=>"MALAYSIA"
		,es=>"MALASIA"
		,it=>"MALESIA"
		,pt=>"MALÁSIA"
		,ru=>"МАЛАЙЗИЯ"
		,zh=>"马来西亚"
		]);}
	public static function txtCountry_MZ(){ return Lemma::txt([__FUNCTION__
		,en=>"MOZAMBIQUE"
		,fr=>"MOZAMBIQUE"
		,de=>"MOSAMBIK"
		,es=>"MOZAMBIQUE"
		,it=>"MOZAMBICO"
		,pt=>"MOÇAMBIQUE"
		,ru=>"МОЗАМБИК"
		,zh=>"莫桑比克"
		]);}
	public static function txtCountry_NA(){ return Lemma::txt([__FUNCTION__
		,en=>"NAMIBIA"
		,fr=>"NAMIBIE"
		,de=>"NAMIBIA"
		,es=>"NAMIBIA"
		,it=>"NAMIBIA"
		,pt=>"NAMÍBIA"
		,ru=>"НАМИБИЯ"
		,zh=>"纳米比亚"
		]);}
	public static function txtCountry_NC(){ return Lemma::txt([__FUNCTION__
		,en=>"NEW CALEDONIA"
		,fr=>"NOUVELLE-CALÉDONIE"
		,de=>"NEUKALEDONIEN"
		,es=>"NUEVA CALEDONIA"
		,it=>"NUOVA CALEDONIA"
		,pt=>"NOVA CALEDÔNIA"
		,ru=>"НОВАЯ КАЛЕДОНИЯ"
		,zh=>"新喀里多尼亚"
		]);}
	public static function txtCountry_NE(){ return Lemma::txt([__FUNCTION__
		,en=>"NIGER"
		,fr=>"NIGER"
		,de=>"NIGERI"
		,es=>"NIGERIA"
		,it=>"NIGER"
		,pt=>"NÍGER"
		,ru=>"НИГЕР"
		,zh=>"尼日尔"
		]);}
	public static function txtCountry_NF(){ return Lemma::txt([__FUNCTION__
		,en=>"NORFOLK ISLAND"
		,fr=>"NORFOLK, ÎLE"
		,de=>"NORFOLK-INSELN"
		,es=>"NORFOLK, ISLA"
		,it=>"ISOLA NORFOLK"
		,pt=>"ILHA NORFOLK"
		,ru=>"О. НОРФОЛК"
		,zh=>"诺福克岛"
		]);}
	public static function txtCountry_NG(){ return Lemma::txt([__FUNCTION__
		,en=>"NIGERIA"
		,fr=>"NIGÉRIA"
		,de=>"NIGERIA"
		,es=>"NIGERIA"
		,it=>"NIGERIA"
		,pt=>"NIGÉRIA"
		,ru=>"НИГЕРИЯ"
		,zh=>"尼日利亚"
		]);}
	public static function txtCountry_NI(){ return Lemma::txt([__FUNCTION__
		,en=>"NICARAGUA"
		,fr=>"NICARAGUA"
		,de=>"NICARAGUA"
		,es=>"NICARAGUA"
		,it=>"NICARAGUA"
		,pt=>"NICARÁGUA"
		,ru=>"НИКАРАГУА"
		,zh=>"尼加拉瓜"
		]);}
	public static function txtCountry_NL(){ return Lemma::txt([__FUNCTION__
		,en=>"NETHERLANDS"
		,fr=>"PAYS-BAS"
		,de=>"NIEDERLANDE"
		,es=>"PAÍSES BAJOS"
		,it=>"PAESI BASSI"
		,pt=>"PAÍSES BAIXOS"
		,ru=>"НИДЕРЛАНДЫ"
		,zh=>"荷兰"
		]);}
	public static function txtCountry_NO(){ return Lemma::txt([__FUNCTION__
		,en=>"NORWAY"
		,fr=>"NORVÈGE"
		,de=>"NORWEGEN"
		,es=>"NORUEGA"
		,it=>"NORVEGIA"
		,pt=>"NORUEGA"
		,ru=>"НОРВЕГИЯ"
		,zh=>"挪威"
		]);}
	public static function txtCountry_NP(){ return Lemma::txt([__FUNCTION__
		,en=>"NEPAL"
		,fr=>"NÉPAL"
		,de=>"NEPAL"
		,es=>"NEPAL"
		,it=>"NEPAL"
		,pt=>"NEPAL"
		,ru=>"НЕПАЛ"
		,zh=>"尼泊尔"
		]);}
	public static function txtCountry_NR(){ return Lemma::txt([__FUNCTION__
		,en=>"NAURU"
		,fr=>"NAURU"
		,de=>"NAURU"
		,es=>"NAURU"
		,it=>"NAURU"
		,pt=>"NAURU"
		,ru=>"НАУРУ"
		,zh=>"瑙鲁"
		]);}
	public static function txtCountry_NU(){ return Lemma::txt([__FUNCTION__
		,en=>"NIUE"
		,fr=>"NIUÉ"
		,de=>"NIUE"
		,es=>"NIUE"
		,it=>"NIUE"
		,pt=>"NIUE"
		,ru=>"НИУЭ"
		,zh=>"纽埃"
		]);}
	public static function txtCountry_NZ(){ return Lemma::txt([__FUNCTION__
		,en=>"NEW ZEALAND"
		,fr=>"NOUVELLE-ZÉLANDE"
		,de=>"NEUSEELAND"
		,es=>"NUEVA ZELANDA"
		,it=>"NUOVA ZELANDA"
		,pt=>"NOVA ZELÂNDIA"
		,ru=>"НОВАЯ ЗЕЛАНДИЯ"
		,zh=>"新西兰"
		]);}
	public static function txtCountry_OM(){ return Lemma::txt([__FUNCTION__
		,en=>"OMAN"
		,fr=>"OMAN"
		,de=>"OMAN"
		,es=>"OMÁN"
		,it=>"OMAN"
		,pt=>"OMÃ"
		,ru=>"ОМАН"
		,zh=>"阿曼"
		]);}
	public static function txtCountry_PA(){ return Lemma::txt([__FUNCTION__
		,en=>"PANAMA"
		,fr=>"PANAMA"
		,de=>"PANAMA"
		,es=>"PANAMÁ"
		,it=>"PANAMA"
		,pt=>"PANAMÁ"
		,ru=>"ПАНАМА"
		,zh=>"巴拿马"
		]);}
	public static function txtCountry_PE(){ return Lemma::txt([__FUNCTION__
		,en=>"PERU"
		,fr=>"PÉROU"
		,de=>"PERU"
		,es=>"PERÚ"
		,it=>"PERÙ"
		,pt=>"PERU"
		,ru=>"ПЕРУ"
		,zh=>"秘鲁"
		]);}
	public static function txtCountry_PF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH POLYNESIA"
		,fr=>"POLYNÉSIE FRANÇAISE"
		,de=>"FRANZÖSISCH POLYNESIEN"
		,es=>"POLINESIA FRANCESA"
		,it=>"POLINESIA FRANCESE"
		,pt=>"POLINÉSIA FRANCESA"
		,ru=>"ФРАНЦУЗСКАЯ ПОЛИНЕЗИЯ"
		,zh=>"法属玻里尼西亚"
		]);}
	public static function txtCountry_PG(){ return Lemma::txt([__FUNCTION__
		,en=>"PAPUA NEW GUINEA"
		,fr=>"PAPOUASIE-NOUVELLE-GUINÉE"
		,de=>"PAPUA NEU GUINEA"
		,es=>"PAPÚA NUEVA GUINEA"
		,it=>"PAPUA NUOVA GUINEA"
		,pt=>"PAPUA NOVA GUINÉ"
		,ru=>"ПАПУА-НОВАЯ ГВИНЕЯ"
		,zh=>"巴布亚新几内亚"
		]);}
	public static function txtCountry_PH(){ return Lemma::txt([__FUNCTION__
		,en=>"PHILIPPINES"
		,fr=>"PHILIPPINES"
		,de=>"PHILLIPPINEN"
		,es=>"FILIPINAS"
		,it=>"FILIPPINE"
		,pt=>"FILIPINAS"
		,ru=>"ФИЛИППИНЫ"
		,zh=>"菲律宾"
		]);}
	public static function txtCountry_PK(){ return Lemma::txt([__FUNCTION__
		,en=>"PAKISTAN"
		,fr=>"PAKISTAN"
		,de=>"PAKISTAN"
		,es=>"PAKISTÁN"
		,it=>"PAKISTAN"
		,pt=>"PAQUISTÃO"
		,ru=>"ПАКИСТАН"
		,zh=>"巴基斯坦"
		]);}
	public static function txtCountry_PL(){ return Lemma::txt([__FUNCTION__
		,en=>"POLAND"
		,fr=>"POLOGNE"
		,de=>"POLEN"
		,es=>"POLONIA"
		,it=>"POLONIA"
		,pt=>"POLÔNIA"
		,ru=>"ПОЛЬША"
		,zh=>"波兰"
		]);}
	public static function txtCountry_PM(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT PIERRE AND MIQUELON"
		,fr=>"SAINT-PIERRE-ET-MIQUELON"
		,de=>"SAINT PIERRE UND MIQUELON"
		,es=>"SAN PEDRO Y MIQUELÓN"
		,it=>"SAINT PIERRE E MIQUELON"
		,pt=>"SÃO PEDRO E MIQUELON"
		,ru=>"СЕН-ПЬЕР И МИКЕЛОН"
		,zh=>"圣皮埃尔和密克隆群岛"
		]);}
	public static function txtCountry_PN(){ return Lemma::txt([__FUNCTION__
		,en=>"PITCAIRN"
		,fr=>"PITCAIRN"
		,de=>"PITCAIRN"
		,es=>"PITCAIRN"
		,it=>"PITCAIRN"
		,pt=>"PITCAIRN"
		,ru=>"ПИТКЭРН"
		,zh=>"皮特凯恩"
		]);}
	public static function txtCountry_PR(){ return Lemma::txt([__FUNCTION__
		,en=>"PUERTO RICO"
		,fr=>"PORTO RICO"
		,de=>"PUERTO RICO"
		,es=>"PUERTO RICO"
		,it=>"PORTORICO"
		,pt=>"PORTO RICO"
		,ru=>"ПУЭРТО-РИКО"
		,zh=>"波多黎各"
		]);}
	public static function txtCountry_PS(){ return Lemma::txt([__FUNCTION__
		,en=>"PALESTINIAN TERRITORY, OCCUPIED"
		,fr=>"PALESTINIEN OCCUPÉ, TERRITOIRE"
		,de=>"PALÄSTINENSER GEBIET, BESETZT"
		,es=>"PALESTINO OCUPADO, TERRITORIO"
		,it=>"PALESTINA"
		,pt=>"TERRITÓRIO PALESTINIANO OCUPADO"
		,ru=>"ОККУПИРОВАННАЯ ПАЛЕСТИНСКАЯ ТЕРРИТОРИЯ"
		,zh=>"巴勒斯坦被占领土"
		]);}
	public static function txtCountry_PT(){ return Lemma::txt([__FUNCTION__
		,en=>"PORTUGAL"
		,fr=>"PORTUGAL"
		,de=>"PORTUGAL"
		,es=>"PORTUGAL"
		,it=>"PORTOGALLO"
		,pt=>"PORTUGAL"
		,ru=>"ПОРТУГАЛИЯ"
		,zh=>"葡萄牙"
		]);}
	public static function txtCountry_PW(){ return Lemma::txt([__FUNCTION__
		,en=>"PALAU"
		,fr=>"PALAOS"
		,de=>"PALAU"
		,es=>"País_PW"
		,it=>"PALAU"
		,pt=>"PALAU"
		,ru=>"ПАЛАУ"
		,zh=>"帕劳"
		]);}
	public static function txtCountry_PY(){ return Lemma::txt([__FUNCTION__
		,en=>"PARAGUAY"
		,fr=>"PARAGUAY"
		,de=>"PARAGUAY"
		,es=>"PARAGUAY"
		,it=>"PARAGUAY"
		,pt=>"PARAGUAI"
		,ru=>"ПАРАГВАЙ"
		,zh=>"巴拉圭"
		]);}
	public static function txtCountry_QA(){ return Lemma::txt([__FUNCTION__
		,en=>"QATAR"
		,fr=>"QATAR"
		,de=>"QATAR"
		,es=>"CATAR"
		,it=>"QATAR"
		,pt=>"CATAR"
		,ru=>"КАТАР"
		,zh=>"卡塔尔"
		]);}
	public static function txtCountry_RE(){ return Lemma::txt([__FUNCTION__
		,en=>"RÉUNION"
		,fr=>"RÉUNION"
		,de=>"RÉUNION"
		,es=>"REUNIÓN"
		,it=>"RÉUNION"
		,pt=>"REUNIÃO"
		,ru=>"РЕЮНЬОН"
		,zh=>"留尼旺"
		]);}
	public static function txtCountry_RO(){ return Lemma::txt([__FUNCTION__
		,en=>"ROMANIA"
		,fr=>"ROUMANIE"
		,de=>"RUMÄNIEN"
		,es=>"RUMANÍA"
		,it=>"ROMANIA"
		,pt=>"ROMÊNIA"
		,ru=>"РУМЫНИЯ"
		,zh=>"罗马尼亚"
		]);}
	public static function txtCountry_RS(){ return Lemma::txt([__FUNCTION__
		,en=>"SERBIA"
		,fr=>"SERBIE"
		,de=>"SERBIEN"
		,es=>"SERBIA"
		,it=>"SERBIA"
		,pt=>"SÉRVIA "
		,ru=>"СЕРБИЯ"
		,zh=>"塞尔维亚"
		]);}
	public static function txtCountry_RU(){ return Lemma::txt([__FUNCTION__
		,en=>"RUSSIAN FEDERATION"
		,fr=>"RUSSIE, FÉDÉRATION DE"
		,de=>"RUSSISCHE FÖDERATION"
		,es=>"RUSIA, FEDERACIÓN DE"
		,it=>"FEDERAZIONE RUSSA"
		,pt=>"FEDERAÇÃO DA RÚSSIA"
		,ru=>"РОССИСКАЯ ФЕДЕРАЦИЯ"
		,zh=>"俄罗斯联邦"
		]);}
	public static function txtCountry_RW(){ return Lemma::txt([__FUNCTION__
		,en=>"RWANDA"
		,fr=>"RWANDA"
		,de=>"RUANDA"
		,es=>"RUANDA"
		,it=>"RUANDA"
		,pt=>"RUANDA"
		,ru=>"РУАНДА"
		,zh=>"卢旺达"
		]);}
	public static function txtCountry_SA(){ return Lemma::txt([__FUNCTION__
		,en=>"SAUDI ARABIA"
		,fr=>"ARABIE SAOUDITE"
		,de=>"SAUDIARABIEN"
		,es=>"ARABIA SAUDITA"
		,it=>"ARABIA SAUDITA"
		,pt=>"ARÁBIA SAUDITA"
		,ru=>"САУДОВСКАЯ АРАВИЯ"
		,zh=>"沙特阿拉伯"
		]);}
	public static function txtCountry_SB(){ return Lemma::txt([__FUNCTION__
		,en=>"SOLOMON ISLANDS"
		,fr=>"SALOMON, ÎLES"
		,de=>"SALOMONINSELN"
		,es=>"SALOMÓN, ISLAS"
		,it=>"ISOLE SALOMON"
		,pt=>"ILHAS SALOMÃO"
		,ru=>"СОЛОМОНОВЫ ОСТРОВА"
		,zh=>"所罗门群岛"
		]);}
	public static function txtCountry_SC(){ return Lemma::txt([__FUNCTION__
		,en=>"SEYCHELLES"
		,fr=>"SEYCHELLES"
		,de=>"SEYCHELLEN"
		,es=>"SEYCHELLES"
		,it=>"SEYCHELLES"
		,pt=>"SEICHELLES "
		,ru=>"СЕЙШЕЛЬСКИЕ ОСТРОВА"
		,zh=>"塞舌尔"
		]);}
	public static function txtCountry_SD(){ return Lemma::txt([__FUNCTION__
		,en=>"SUDAN"
		,fr=>"SOUDAN"
		,de=>"SUDAN"
		,es=>"SUDÁN"
		,it=>"SUDAN"
		,pt=>"SUDÃO"
		,ru=>"СУДАН"
		,zh=>"苏丹"
		]);}
	public static function txtCountry_SE(){ return Lemma::txt([__FUNCTION__
		,en=>"SWEDEN"
		,fr=>"SUÈDE"
		,de=>"SCHWEDEN"
		,es=>"SUECIA"
		,it=>"SVEZIA"
		,pt=>"SUÉCIA"
		,ru=>"ШВЕЦИЯ"
		,zh=>"瑞典"
		]);}
	public static function txtCountry_SG(){ return Lemma::txt([__FUNCTION__
		,en=>"SINGAPORE"
		,fr=>"SINGAPOUR"
		,de=>"SINGAPUR"
		,es=>"SINGAPUR"
		,it=>"SINGAPORE"
		,pt=>"SINGAPURA"
		,ru=>"СИНГАПУР"
		,zh=>"新加坡"
		]);}
	public static function txtCountry_SH(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA"
		,fr=>"SAINTE-HÉLÈNE, ASCENSION ET TRISTAN DA CUNHA"
		,de=>"ST. HELENA UND DIE INSELN  TRISTAN DA CUNHA UND ASCENSION"
		,es=>"SANTA ELENA, ASCENSIÓN Y TRISTÁN DE ACUÑA"
		,it=>"SAINT HELENA, ASCENSION E TRISTAN DA CUNHA"
		,pt=>"SANTA HELENA, ASCENÇÃO E TRISTÃO DA CUNHA"
		,ru=>"ОСТРОВА СВЯТОЙ ЕЛЕНЫ, ВОЗНЕСЕНИЯ И ТРИСТАН-ДА-КУНЬЯ"
		,zh=>"圣赫勒拿，阿森松岛和特里斯坦—达库尼亚群岛"
		]);}
	public static function txtCountry_SI(){ return Lemma::txt([__FUNCTION__
		,en=>"SLOVENIA"
		,fr=>"SLOVÉNIE"
		,de=>"SLOWENIEN"
		,es=>"ESLOVENIA"
		,it=>"SLOVENIA"
		,pt=>"ESLOVÊNIA "
		,ru=>"СЛОВЕНИЯ"
		,zh=>"斯洛文尼亚"
		]);}
	public static function txtCountry_SJ(){ return Lemma::txt([__FUNCTION__
		,en=>"SVALBARD AND JAN MAYEN"
		,fr=>"SVALBARD ET ÎLE JAN MAYEN"
		,de=>"SVALBARD UND DIE INSEL JAN MAYEN"
		,es=>"SVALBARD E ISLA JAN MAYEN"
		,it=>"SVALBARD E JAN MAYEN"
		,pt=>"ESVALBARDA E JAN MAYEN"
		,ru=>"ШПИЦБЕРГЕН И ЯН-МАЙЕН"
		,zh=>"斯瓦尔巴和扬马延"
		]);}
	public static function txtCountry_SK(){ return Lemma::txt([__FUNCTION__
		,en=>"SLOVAKIA"
		,fr=>"SLOVAQUIE"
		,de=>"SLOWAKIEN"
		,es=>"ESLOVAQUIA"
		,it=>"SLOVACCHIA"
		,pt=>"ESLOVÁQUIA"
		,ru=>"СЛОВАКИЯ"
		,zh=>"斯洛伐克"
		]);}
	public static function txtCountry_SL(){ return Lemma::txt([__FUNCTION__
		,en=>"SIERRA LEONE"
		,fr=>"SIERRA LEONE"
		,de=>"SIERRA LEONE"
		,es=>"SIERRA LEONA"
		,it=>"SIERRA LEONE"
		,pt=>"SERRA LEOA"
		,ru=>"СЬЕРРА-ЛЕОНЕ"
		,zh=>"塞拉利昂"
		]);}
	public static function txtCountry_SM(){ return Lemma::txt([__FUNCTION__
		,en=>"SAN MARINO"
		,fr=>"SAINT-MARIN"
		,de=>"SAN MARINO"
		,es=>"SAN MARINO"
		,it=>"SAN MARINO"
		,pt=>"SÃO MARINO"
		,ru=>"САН-МАРИНО"
		,zh=>"圣马力诺"
		]);}
	public static function txtCountry_SN(){ return Lemma::txt([__FUNCTION__
		,en=>"SENEGAL"
		,fr=>"SÉNÉGAL"
		,de=>"SENEGAL"
		,es=>"SENEGAL"
		,it=>"SENEGAL"
		,pt=>"SENEGAL"
		,ru=>"СЕНЕГАЛ"
		,zh=>"塞内加尔"
		]);}
	public static function txtCountry_SO(){ return Lemma::txt([__FUNCTION__
		,en=>"SOMALIA"
		,fr=>"SOMALIE"
		,de=>"SOMALIA"
		,es=>"SOMALIA"
		,it=>"SOMALIA"
		,pt=>"SOMÁLIA"
		,ru=>"СОМАЛИ"
		,zh=>"索马里"
		]);}
	public static function txtCountry_SR(){ return Lemma::txt([__FUNCTION__
		,en=>"SURINAME"
		,fr=>"SURINAME"
		,de=>"SURINAME"
		,es=>"SURINAM"
		,it=>"SURINAME"
		,pt=>"SURINAME"
		,ru=>"СУРИНАМ"
		,zh=>"苏里南"
		]);}
	public static function txtCountry_ST(){ return Lemma::txt([__FUNCTION__
		,en=>"SAO TOME AND PRINCIPE"
		,fr=>"SAO TOMÉ-ET-PRINCIPE"
		,de=>"SAO TOME UND PRINCIPE"
		,es=>"SANTO TOMÉ Y PRÍNCIPE"
		,it=>"SAO TOME E PRINCIPE"
		,pt=>"SÃO TOMÉ E PRÍNCIPE"
		,ru=>"САН-ТОМЕ И ПРИНСИПИ"
		,zh=>"圣多美与普林希比共和国"
		]);}
	public static function txtCountry_SV(){ return Lemma::txt([__FUNCTION__
		,en=>"EL SALVADOR"
		,fr=>"EL SALVADOR"
		,de=>"EL SALVADOR"
		,es=>"EL SALVADOR"
		,it=>"EL SALVADOR"
		,pt=>"EL SALVADOR"
		,ru=>"САЛЬВАДОР"
		,zh=>"萨尔瓦多"
		]);}
	public static function txtCountry_SX(){ return Lemma::txt([__FUNCTION__
		,en=>"SINT MAARTEN (DUTCH PART)"
		,fr=>"SAINT-MARTIN (PARTIE NÉERLANDAISE)"
		,de=>"SANKT MARTIN (NIEDERLÄNDISCHER TEIL) "
		,es=>"SAINT MARTIN (PARTE HOLANDESA)"
		,it=>"SINT MAARTEN (PARTE OLANDESE)"
		,pt=>"SÃO MARTINHO (PARTE HOLANDESA)"
		,ru=>"СИНТ-МАРТЕН (НИДЕРЛАНДСКАЯ ЧАСТЬ)"
		,zh=>"圣马丁（荷属）"
		]);}
	public static function txtCountry_SY(){ return Lemma::txt([__FUNCTION__
		,en=>"SYRIAN ARAB REPUBLIC"
		,fr=>"SYRIENNE, RÉPUBLIQUE ARABE"
		,de=>"SYRIEN, ARABISCHE REPUBLIK"
		,es=>"SIRIA, REPÚBLICA ÁRABE"
		,it=>"SIRIA"
		,pt=>"REPÚBLICA ÁRABE DA SÍRIA"
		,ru=>"СИРИЙСКАЯ АРАБСКАЯ РЕСПУБЛИКА"
		,zh=>"阿拉伯叙利亚共和国"
		]);}
	public static function txtCountry_SZ(){ return Lemma::txt([__FUNCTION__
		,en=>"SWAZILAND"
		,fr=>"SWAZILAND"
		,de=>"SWAZILAND"
		,es=>"SUAZILANDIA"
		,it=>"SWAZILAND"
		,pt=>"SUAZILÂNDIA"
		,ru=>"СВАЗИЛЕНД"
		,zh=>"威士兰"
		]);}
	public static function txtCountry_TC(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKS AND CAICOS ISLANDS"
		,fr=>"TURKS ET CAÏQUES, ÎLES"
		,de=>"TURKS UND CAICOS INSELN"
		,es=>"ISLAS TURCAS Y CAICOS"
		,it=>"ISOLE TURKS E CAICOS"
		,pt=>"ILHAS TURCAS E CAICOS"
		,ru=>"О-ВА ТЕРКС И КАЙКОС"
		,zh=>"特克斯和凯科斯群岛"
		]);}
	public static function txtCountry_TD(){ return Lemma::txt([__FUNCTION__
		,en=>"CHAD"
		,fr=>"TCHAD"
		,de=>"TSCHAD"
		,es=>"CHAD"
		,it=>"CIAD"
		,pt=>"CHADE"
		,ru=>"ЧАД"
		,zh=>"乍得"
		]);}
	public static function txtCountry_TF(){ return Lemma::txt([__FUNCTION__
		,en=>"FRENCH SOUTHERN TERRITORIES"
		,fr=>"TERRES AUSTRALES FRANÇAISES"
		,de=>"FRANZÖSISCHE SÜDPOLAR-TERRITORIEN"
		,es=>"TIERRAS AUSTRALES Y ANTÁRTICAS FRANCESAS"
		,it=>"TERRE AUSTRALI FRANCESI"
		,pt=>"TERRITÓRIOS FRANCESES DO SUL"
		,ru=>"ФРАНЦУЗСКИЕ ЮЖНЫЕ ТЕРРИТОРИИ"
		,zh=>"法属南半球领地"
		]);}
	public static function txtCountry_TG(){ return Lemma::txt([__FUNCTION__
		,en=>"TOGO"
		,fr=>"TOGO"
		,de=>"TOGO"
		,es=>"TOGO"
		,it=>"TOGO"
		,pt=>"TOGO"
		,ru=>"ТОГО"
		,zh=>"多哥"
		]);}
	public static function txtCountry_TH(){ return Lemma::txt([__FUNCTION__
		,en=>"THAILAND"
		,fr=>"THAÏLANDE"
		,de=>"THAILAND"
		,es=>"TAILANDIA"
		,it=>"THAILANDIA"
		,pt=>"TAILÂNDIA"
		,ru=>"ТАИЛАНД"
		,zh=>"泰国"
		]);}
	public static function txtCountry_TJ(){ return Lemma::txt([__FUNCTION__
		,en=>"TAJIKISTAN"
		,fr=>"TADJIKISTAN"
		,de=>"TADSCHIKISTAN"
		,es=>"TAYIKISTÁN"
		,it=>"TAGIKISTAN"
		,pt=>"TADJIQUISTÃO"
		,ru=>"ТАДЖИКИСТАН"
		,zh=>"塔吉克斯坦"
		]);}
	public static function txtCountry_TK(){ return Lemma::txt([__FUNCTION__
		,en=>"TOKELAU"
		,fr=>"TOKELAU"
		,de=>"TOKELAU"
		,es=>"TOKELAU"
		,it=>"TOKELAU"
		,pt=>"TOQUELAU "
		,ru=>"ТОКЕЛАУ"
		,zh=>"托克劳"
		]);}
	public static function txtCountry_TL(){ return Lemma::txt([__FUNCTION__
		,en=>"TIMOR-LESTE"
		,fr=>"TIMOR-LESTE"
		,de=>"TIMOR-LESTE"
		,es=>"TIMOR-LESTE"
		,it=>"TIMOR-LESTE"
		,pt=>"TIMOR-LESTE"
		,ru=>"ВОСТОЧНЫЙ ТИМОР"
		,zh=>"东帝汶"
		]);}
	public static function txtCountry_TM(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKMENISTAN"
		,fr=>"TURKMÉNISTAN"
		,de=>"TURKMENISTAN"
		,es=>"TURKMENISTÁN"
		,it=>"TURKMENISTAN"
		,pt=>"TURCOMENISTÃO"
		,ru=>"ТУРКМЕНИСТАН"
		,zh=>"土库曼斯坦"
		]);}
	public static function txtCountry_TN(){ return Lemma::txt([__FUNCTION__
		,en=>"TUNISIA"
		,fr=>"TUNISIE"
		,de=>"TUNESIEN"
		,es=>"TÚNEZ"
		,it=>"TURCHIA"
		,pt=>"TUNÍSIA"
		,ru=>"ТУНИС"
		,zh=>"突尼斯"
		]);}
	public static function txtCountry_TO(){ return Lemma::txt([__FUNCTION__
		,en=>"TONGA"
		,fr=>"TONGA"
		,de=>"TONGA"
		,es=>"TONGA"
		,it=>"TONGA"
		,pt=>"TONGA"
		,ru=>"ТОНГА"
		,zh=>"汤加"
		]);}
	public static function txtCountry_TR(){ return Lemma::txt([__FUNCTION__
		,en=>"TURKEY"
		,fr=>"TURQUIE"
		,de=>"TÜRKEI"
		,es=>"TURQUÍA"
		,it=>"TURCHIA"
		,pt=>"TURQUIA"
		,ru=>"ТУРЦИЯ"
		,zh=>"土耳其"
		]);}
	public static function txtCountry_TT(){ return Lemma::txt([__FUNCTION__
		,en=>"TRINIDAD AND TOBAGO"
		,fr=>"TRINITÉ-ET-TOBAGO"
		,de=>"TRINIDAD UND TOBAGO"
		,es=>"TRINIDAD Y TOBAGO"
		,it=>"TRINIDAD E TOBAGO"
		,pt=>"TRINIDADE E TOBAGO"
		,ru=>"ТРИНИДАД И ТОБАГО"
		,zh=>"特立尼达和多巴哥"
		]);}
	public static function txtCountry_TV(){ return Lemma::txt([__FUNCTION__
		,en=>"TUVALU"
		,fr=>"TUVALU"
		,de=>"TUVALU"
		,es=>"TUVALU"
		,it=>"TUVALU"
		,pt=>"TUVALU"
		,ru=>"ТУВАЛУ"
		,zh=>"图瓦卢"
		]);}
	public static function txtCountry_TW(){ return Lemma::txt([__FUNCTION__
		,en=>"TAIWAN, PROVINCE OF CHINA"
		,fr=>"TAÏWAN, PROVINCE DE CHINE"
		,de=>"TAIWAN, CHINESISCHE PROVINZ"
		,es=>"TAIWÁN, PROVINCIA DE CHINA"
		,it=>"TAIWAN"
		,pt=>"TAIUÃ, Província da China"
		,ru=>"ТАЙВАНЬ, ПРОВИНЦИЯ КИТАЯ"
		,zh=>"中国省台湾"
		]);}
	public static function txtCountry_TZ(){ return Lemma::txt([__FUNCTION__
		,en=>"TANZANIA, UNITED REPUBLIC OF"
		,fr=>"TANZANIE, RÉPUBLIQUE-UNIE DE"
		,de=>"TANSANIA, VEREINIGTE REPUBLIK VON"
		,es=>"TANZANIA, REPÚBLICA UNIDA DE"
		,it=>"TANZANIA"
		,pt=>"TANZÂNIA, REPÚBLICA UNIDA DA"
		,ru=>"ОБЪЕДИНЕННАЯ РЕСПУБЛИКА ТАНЗАНИЯ"
		,zh=>"坦桑尼亚联合共和国"
		]);}
	public static function txtCountry_UA(){ return Lemma::txt([__FUNCTION__
		,en=>"UKRAINE"
		,fr=>"UKRAINE"
		,de=>"UKRAINE"
		,es=>"UCRANIA"
		,it=>"UCRAINA"
		,pt=>"UCRÂNIA "
		,ru=>"УКРАИНА"
		,zh=>"乌克兰"
		]);}
	public static function txtCountry_UG(){ return Lemma::txt([__FUNCTION__
		,en=>"UGANDA"
		,fr=>"OUGANDA"
		,de=>"UGANDA"
		,es=>"UGANDA"
		,it=>"UGANDA"
		,pt=>"UGANDA"
		,ru=>"УГАНДА"
		,zh=>"乌干达"
		]);}
	public static function txtCountry_UM(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED STATES MINOR OUTLYING ISLANDS"
		,fr=>"ÎLES MINEURES ÉLOIGNÉES DES ÉTATS-UNIS"
		,de=>"AMERIKANISCH-OZEANIEN"
		,es=>"ISLAS ULTRAMARINAS MENORES DE ESTADOS UNIDOS"
		,it=>"ISOLE MINORI ESTERNE DEGLI STATI UNITI"
		,pt=>"ILHAS MENORES DISTANTES DOS ESTADOS UNIDOS"
		,ru=>"МАЛЫЕ ВНЕШНИЕ О-ВА, ПРИНАДЛЕЖАЩИЕ США"
		,zh=>"美国本土外小岛屿"
		]);}
	public static function txtCountry_US(){ return Lemma::txt([__FUNCTION__
		,en=>"UNITED STATES"
		,fr=>"ÉTATS-UNIS"
		,de=>"VEREINIGTE STAATEN VON AMERIKA"
		,es=>"ESTADOS UNIDOS"
		,it=>"STATI UNITI"
		,pt=>"ESTADOS UNIDOS"
		,ru=>"США"
		,zh=>"美国"
		]);}
	public static function txtCountry_UY(){ return Lemma::txt([__FUNCTION__
		,en=>"URUGUAY"
		,fr=>"URUGUAY"
		,de=>"URUGUAY"
		,es=>"URUGUAY"
		,it=>"URUGUAY"
		,pt=>"URUGUAI"
		,ru=>"УРУГВАЙ"
		,zh=>"乌拉圭"
		]);}
	public static function txtCountry_UZ(){ return Lemma::txt([__FUNCTION__
		,en=>"UZBEKISTAN"
		,fr=>"OUZBÉKISTAN"
		,de=>"USBEKISTAN"
		,es=>"UZBEKISTÁN"
		,it=>"UZBEKISTAN"
		,pt=>"UZBEQUISTÃO"
		,ru=>"УЗБЕКИСТАН"
		,zh=>"乌兹别克斯坦"
		]);}
	public static function txtCountry_VA(){ return Lemma::txt([__FUNCTION__
		,en=>"HOLY SEE (VATICAN CITY STATE)"
		,fr=>"SAINT-SIÈGE (ÉTAT DE LA CITÉ DU VATICAN)"
		,de=>"HEILIGER STUHL (VATIKANSTADT)"
		,es=>"SANTA SEDE (CIUDAD ESTADO DEL VATICANO)"
		,it=>"SANTA SEDE (CITTÀ DEL VATICANO)"
		,pt=>"SANTA SÉ (ESTADO DA CIDADE DO VATICANO)"
		,ru=>"ПАПСКИЙ ПРЕСТОЛ (ГОСУДАРСТВО-ГОРОД ВАТИКАН)"
		,zh=>"圣座（梵蒂冈城国）"
		]);}
	public static function txtCountry_VC(){ return Lemma::txt([__FUNCTION__
		,en=>"SAINT VINCENT AND THE GRENADINES"
		,fr=>"SAINT-VINCENT-ET-LES GRENADINES"
		,de=>"SANKT VINCENT UND DIE GRENADINEN"
		,es=>"SAN VICENTE Y LAS GRANADINAS"
		,it=>"SAINT VINCENT E GRENADINE"
		,pt=>"SÃO VICENTE E GRANADINAS"
		,ru=>"СЕНТ-ВИНСЕНТ И ГРЕНАДИНЫ"
		,zh=>"圣文森特和格林纳丁斯"
		]);}
	public static function txtCountry_VE(){ return Lemma::txt([__FUNCTION__
		,en=>"VENEZUELA, BOLIVARIAN REPUBLIC OF"
		,fr=>"VENEZUELA, RÉPUBLIQUE BOLIVARIENNE DU"
		,de=>"VENEZUELA, BOLIVARISCHE REPUBLIK"
		,es=>"VENEZUELA, REPÚBLICA BOLIVARIANA DE"
		,it=>"VENEZUELA"
		,pt=>"VENEZUELA, REPÚBLICA BOLIVARIANA DA"
		,ru=>"БОЛИВАРИАНСКАЯ РЕСПУБЛИКА ВЕНЕСУЭЛА"
		,zh=>"委内瑞拉玻利瓦尔共和国"
		]);}
	public static function txtCountry_VG(){ return Lemma::txt([__FUNCTION__
		,en=>"VIRGIN ISLANDS, BRITISH"
		,fr=>"ÎLES VIERGES BRITANNIQUES"
		,de=>"BRITISCHE JUNGFERNINSELN"
		,es=>"ISLAS VÍRGENES BRITÁNICAS"
		,it=>"ISOLE VERGINI BRITANNICHE"
		,pt=>"ILHAS VIRGENS BRITÂNICAS"
		,ru=>"ВИРГИНСКИЕ О-ВА, ВЕЛИКОБРИТАНИЯ"
		,zh=>"英属维尔京群岛"
		]);}
	public static function txtCountry_VI(){ return Lemma::txt([__FUNCTION__
		,en=>"VIRGIN ISLANDS, U.S."
		,fr=>"ÎLES VIERGES DES ÉTATS-UNIS"
		,de=>"US-JUNGFERNINSELN"
		,es=>"ISLAS VÍRGENES DE LOS ESTADOS UNIDOS"
		,it=>"ISOLE VERGINI DEGLI STATI UNITI"
		,pt=>"ILHAS VIRGENS, EUA"
		,ru=>"ВИРГИНСКИЕ О-ВА, США"
		,zh=>"美属维尔京群岛"
		]);}
	public static function txtCountry_VN(){ return Lemma::txt([__FUNCTION__
		,en=>"VIET NAM"
		,fr=>"VIET NAM"
		,de=>"VIETNAM"
		,es=>"VIETNAM"
		,it=>"VIETNAM"
		,pt=>"VIETNÃ"
		,ru=>"ВЬЕТНАМ"
		,zh=>"越南"
		]);}
	public static function txtCountry_VU(){ return Lemma::txt([__FUNCTION__
		,en=>"VANUATU"
		,fr=>"VANUATU"
		,de=>"VANUATU"
		,es=>"VANUATU"
		,it=>"VANUATU"
		,pt=>"VANUATU"
		,ru=>"ВАНУАТУ"
		,zh=>"瓦努阿图"
		]);}
	public static function txtCountry_WF(){ return Lemma::txt([__FUNCTION__
		,en=>"WALLIS AND FUTUNA"
		,fr=>"WALLIS ET FUTUNA"
		,de=>"WALLIS UND FUTUNA"
		,es=>"WALLIS Y FUTUNA"
		,it=>"WALLIS E FUTUNA"
		,pt=>"WALLIS E FUTUNA"
		,ru=>"УОЛЛИС И ФУТУНА"
		,zh=>"瓦利斯和富图纳群岛"
		]);}
	public static function txtCountry_WS(){ return Lemma::txt([__FUNCTION__
		,en=>"SAMOA"
		,fr=>"SAMOA"
		,de=>"SAMOA"
		,es=>"SAMOA"
		,it=>"SAMOA"
		,pt=>"SAMOA"
		,ru=>"САМОА"
		,zh=>"萨摩亚"
		]);}
	public static function txtCountry_YE(){ return Lemma::txt([__FUNCTION__
		,en=>"YEMEN"
		,fr=>"YÉMEN"
		,de=>"JEMEN"
		,es=>"YEMEN"
		,it=>"YEMEN"
		,pt=>"IÊMEN"
		,ru=>"ЙЕМЕН"
		,zh=>"也门"
		]);}
	public static function txtCountry_YT(){ return Lemma::txt([__FUNCTION__
		,en=>"MAYOTTE"
		,fr=>"MAYOTTE"
		,de=>"MAYOTTE"
		,es=>"MAYOTTE"
		,it=>"MAYOTTE"
		,pt=>"MAIOTE"
		,ru=>"МАЙОТТ"
		,zh=>"马约特岛"
		]);}
	public static function txtCountry_ZA(){ return Lemma::txt([__FUNCTION__
		,en=>"SOUTH AFRICA"
		,fr=>"AFRIQUE DU SUD"
		,de=>"SÜDAFRIKA"
		,es=>"SUDÁFRICA"
		,it=>"AFRICA DEL SUD"
		,pt=>"ÁFRICA DO SUL"
		,ru=>"ЮЖНАЯ АФРИКА"
		,zh=>"南非"
		]);}
	public static function txtCountry_ZM(){ return Lemma::txt([__FUNCTION__
		,en=>"ZAMBIA"
		,fr=>"ZAMBIE"
		,de=>"SAMBIA"
		,es=>"ZAMBIA"
		,it=>"ZAMBIA"
		,pt=>"ZÂMBIA"
		,ru=>"ЗАМБИЯ"
		,zh=>"赞比亚"
		]);}
	public static function txtCountry_ZW(){ return Lemma::txt([__FUNCTION__
		,en=>"ZIMBABWE"
		,fr=>"ZIMBABWE"
		,de=>"ZIMBABWE"
		,es=>"ZIMBABWE"
		,it=>"ZIMBAWE"
		,pt=>"ZIMBÁBUE"
		,ru=>"ЗИМБАБВЕ"
		,zh=>"津巴布韦"
		]);}

}

