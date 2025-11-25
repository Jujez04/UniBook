# UniBook

## Funzionalità

- Ricerca di un documento in base al libro
- Ricerca del documento in base al tag
- Possibilità di registrarsi e modificare il profilo
  - matricola come identificatore
  - il resto è modificabile (credo) -> utente(idmatricola, nome, cognome, email, immagineprofilo, telefono)
- info point(FAQ) per la gestione delle prenotazioni e prestiti -> unibo
- Ricerca del documento per catalogo (catalogo registrato nel momento dell'inserimento)
- Possibilità di recensire un documento una volta restituito
- Possibilità di vedere le prenotazioni, prestiti, documenti in restituzione e recensioni
- L'amministratore ha il controllo sulla gestione dei documenti all'interno del database, infatti può:
  - aggiungere
  - eliminare
  - modificare -> cambiare catalogo di appartenenza, numero di copie disponibili (?), ...
- Workflow della creazione del prestito:
  1. l'utente esegue la prenotazione in una determinata data, mettendosi in coda
  2. l'amministratore avrà la possibilità di vedere chi è in coda e accettare la prenotazione dei primi della coda
  3. l'amministratore crea il prestito cancellando la prenotazione dalla coda
  4. poi si esegue la logica della gestione della restituzione.
- Gestione restituzione

5. tramite l'assegnazione andiamo a vedere se è stato restituito (ovvero assegnazione dovrà tenere conto dello stato del prestito che può essere "in prestito", "in restituzione" o "restituito")
6. l'utente può passare da "in prestito" a "in restituzione" inoltrando una richiesta
7. l'amministratore è in grado di accettare la richiesta di prestito e passare da "in restituzione" a "restituito"
8. l'utente può lasciare una recensione quando il libro è stato restituito

- Possibilità di vedere le informazioni sul documento
