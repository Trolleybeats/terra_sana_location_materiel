export type User = {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    type_id: number;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};

export type Particulier = {
    id: number;
    user_id: number;
    nom: string;
    prenom: string;
    nom_rue: string;
    numero_rue: number;
    nom_commune_id: number;
    numero_commune_id: number;
    pays_id: number;
    langue_id: number;
    created_at: string;
    updated_at: string;
};

export type Professionnel = {
    id: number;
    user_id: number;
    nom_societe: string;
    nom_rue_siege: string;
    numero_rue_siege: number;
    nom_commune_siege_id: number;
    numero_commune_siege_id: number;
    nom_rue_livraison: string;
    numero_rue_livraison: number;
    nom_commune_livraison_id: number;
    numero_commune_livraison_id: number;
    pays_id: number;
    heure_ouverture: number;
    minute_ouverture: number;
    heure_fermeture: number;
    minute_fermeture: number;
    langue_id: number;
    created_at: string;
    updated_at: string;
};

export type Auth = {
    user: User;
};

export type TwoFactorConfigContent = {
    title: string;
    description: string;
    buttonText: string;
};
