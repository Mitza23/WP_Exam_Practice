using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using documents_NET.DataAbstractionLayer;
using documents_NET.Models;

namespace documents_NET.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();
        }

        public string buildResult(List<Document> documents)
        {
            

            string result = "<table class='table'><thead class='thead'><th scope='col'>Id</th><th scope='col'>Title</th><th scope='col'>Templates</th><th scope='col'></th></thead>";

            for (int i = 0; i < documents.Count; i++)
            {
                Document document = documents[i];

                string templates = "";
                foreach (string template in document.templates)
                {
                    templates += template;
                    templates += ", ";

                }
                templates = templates.Remove(templates.Length - 2);

                if (i % 2 == 1)
                {
                    result += "<tr style='background-color:#e6c670'>";
                }
                else
                {
                    result += "<tr>";
                }
                result += "<td>" + document.id + "</td><td>" + document.title + "</td><td>" + templates + "</td><td><a><button class='btn btn-outline - info' onclick='onUpdateClicked(" + document.id + ")'>Generate</button></a></td></tr>";
            }

            result += "</table>";
            return result;
        }

        public string GetDocuments()
        {

            DAL dal = new DAL();
            List<Document> documentsList = dal.GetDocuments();

            return buildResult(documentsList);
        }

        public string Filter()
        {
            string title = Request.Params["title"];
            DAL dal = new DAL();
            List<Document> documentsList = dal.FilterByTitle(title);
            return buildResult(documentsList);
        }
    }
}