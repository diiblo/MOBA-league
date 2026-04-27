# MLBB Tournament Platform (Cameroun)

Application web pour **créer, organiser et suivre** des compétitions **Mobile Legends: Bang Bang (MLBB)** au Cameroun, avec :
- gestion de **lieux** (adresse, capacité, contacts, créneaux),
- compétitions **League / Cup** (formats flexibles BO1/BO3/BO5),
- équipes + rosters,
- génération et planification de matchs,
- **preuves par screenshots** + **validation IA** + **review**,
- pages **publiques** (vitrine + calendrier + résultats + standings/bracket),
- audit des actions sensibles.

---

## Objectif (MVP)
Livrer un produit qui permet à un organisateur de :
1) créer une compétition rattachée à un lieu,
2) accepter des équipes,
3) générer et planifier les matchs,
4) publier les résultats (IA + review),
5) afficher le tout au public.


---

## Todo liste (non-exhaustive)

- [ ] `auth/` : signup/login/oauth
- [ ] `teams/` : teams, roster, capitaine
- [ ] `venues/` : lieux, slots, conflits
- [ ] `competitions/` : compétitions, configuration, ruleset
- [ ] `registrations/` : inscriptions, validation
- [ ] `matches/` : génération, planning
- [ ] `results/` : evidence, IA, auto-validate, review, standings/bracket updates
- [ ] `public/` : endpoints publics (read-only)
- [ ] `shared/` : audit, storage, validators, helpers, errors, logging
