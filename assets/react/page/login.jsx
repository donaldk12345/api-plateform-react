import React, { useContext, useState } from "react";
import { toast } from "react-toastify";
import Field from "../form/field";
import AuthService from "../services/authentication";
import Navigation from "./nav";
import AuthContext from "../contexts/AuthContext";

export default function LoginPage({ history }) {
  const [credentials, setCredentials] = useState({
    username: "",
    password: "",
  });

  const [error, setError] = useState("");

  function handleChange({ currentTarget }) {

    setCredentials({
      ...credentials,
      [currentTarget.name]: currentTarget.value,
    });
  }

  async function handleSubmit(event) {
    event.preventDefault();

    try {
      await AuthService.login(credentials);
      setError("");
      toast.success("Authentification réussie !")
      //history.replace("/customers");
    } catch (error) {
        console.log(error);
        toast.error(error);
      setError(
        "Aucun compte ne possède cette adresse ou alors les informations ne correspondent pas"
      );
    }
  }

  return (
    <div>
     <Navigation />
      <h1>Connexion à l'application</h1>

      <form onSubmit={handleSubmit}>
        <Field
          name="username"
          label="Adresse email"
          value={credentials.username}
          onChange={handleChange}
          placeholder="Adresse email de connexion"
          type="email"
          error={error}
        />

        <Field
          name="password"
          label="Mot de passe"
          value={credentials.password}
          onChange={handleChange}
          placeholder="Mot de passe de connexion"
          type="password"
        />

        <div className="form-group">
          <button type="submit" className="btn btn-success">
            Connexion
          </button>
        </div>
      </form>
    </div>
  );
}
