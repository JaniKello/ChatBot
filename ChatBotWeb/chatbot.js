var messages = [];

var questions = []; // haetaan kannasta tähän kaikki kysymykset
var answerID = [];	// jokaiselle kysymykselle on oma vastausID, jolla voidaan hakea kannasta tiettyä vastausta

var newMessage = document.getElementById("newMsg"); 
var msgTable = document.getElementById("messages"); 
 
var question = -1;
var ala = 0; // 1 = tieto, 2 = kone, 3 = sähkö
 
 ChatBot("");
 
 newMessage.addEventListener("keyup", function(event)
 {
	event.preventDefault();
	
	if (event.keyCode === 13)
	{
		ChatBot(newMessage.value);
		newMessage.value = "";
	}
 });
 
 function LoadQuestions()
 {
	 
 }
 
 function ChatBot(msg)
 {
	//omateksti -------------------------------------
	if (msg != "")
	{
		SetText("Sina: " + msg);
	}
	
	//botin vastaus --------------------------------
	
	var vastaus = "Botti: ";
        
        if (question == 0 || question < 0)
        {
            if (msg != "")
            {
                var answered = false;
                
                if (msg.includes("terve") || msg.includes("moi") || msg.includes("hei") || msg.includes("moro") || msg.includes("mo"))
                {
                    switch (randomNum(0, 2))
                    {
                        case 0:
                            vastaus += "moi";
                            break;
                        case 1:
                            vastaus += "hei";
                            break;
                        case 2:
                            vastaus += "moro";
                            break;
                        case 3:
                            vastaus += "terve";
                            break;
                    }
                    
					SetText(vastaus);
                    answered = true;
                }
                
                // laskin
                 if (msg.includes("laske"))
                 {
                    var laskutoimitus = "";
                    
                    for(var i = 0; i < msg.length; i++)
                    { // if (!isNaN(parseInt(msg.charAt(i), 10))) {
                       if(!isNaN(parseInt(msg.charAt(i), 10)) || msg.charAt(i) == '-' || msg.charAt(i) == '+' || msg.charAt(i) == '*' || 
                               msg.charAt(i) == '/' || msg.charAt(i) == '.' || msg.charAt(i) == '^' || msg.charAt(i) == '(' || msg.charAt(i) == ')')
                       {
                           laskutoimitus += msg.charAt(i);
                       }
                    }
                     
					 
					 SetText("Botti: " + laskutoimitus + " = " + eval(laskutoimitus));
                    
                    answered = true;
                 }
                 
                 if (msg.includes("paivamaara"))
                 {
                     var d = new Date();
                     SetText("Botti: Nyt on " + d.getDate() + "." + (d.getMonth() + 1) + "." + d.getFullYear());
                     
                     answered = true;
                 }
                 
                 if (msg.includes("kello"))
                 {
					 
                     var d = new Date();
                     SetText("Botti: kello on " + d.getHours() + ":" + d.getMinutes());
                     
                     answered = true;
                 }
                 
                 // lähettää viestin tietokantaan, jos botti ei osannut vastata
                 if (answered == false)
                 {
					 Send(msg);
                 }    
            }
            else
            {
                if (question == -1)
                {
                    vastaus += "Minkä alan opiskelija olet?";
                    question = 1;
                    SetText(vastaus);
                }
            }
        }
        else
        {
            switch (question)
            {
                case 1:
                    
                    if (msg.includes("tietotek"))
                    {
                        vastaus += "Ok";
                        ala = 1;
                        question = 0;
                        SetText(vastaus);
                    }
                    
                    if (msg.includes("konetek"))
                    {
                        vastaus += "Ok";
                        ala = 2;
                        question = 0;
                        SetText(vastaus);
                    }
                    
                    if (msg.includes("sähkötek"))
                    {
                        vastaus += "Ok";
                        ala = 3;
                        question = 0;
                        SetText(vastaus);
                    }
                    
                    break; 
            }
        }
		
		
	}
	
	
	// lähettää viestin tietokantaan
	function Send(x)
	{
		$.ajax({
		type: 'POST',
		data: { k: x },
		url: 'tallenna.php',
		// dataType: 'json',
		async: true,
	  });
	}
	
	function randomNum (min, max)
    {
        var i = min + (Math.random() * ((max - min) + 1));
        return Math.round(i);
    }
	
	function SetText (t)
	{
		messages.push(t);
		var newMsg = "";
		for (var i = 0; i < messages.length; i++)
		{
			newMsg += "<tr><td>" + messages[i] + "</td></tr>";
		}
		msgTable.innerHTML = newMsg;
	}