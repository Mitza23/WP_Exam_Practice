using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using documents_NET.DataAbstractionLayer;

namespace documents_NET.Controllers
{
    public class GenerateController : Controller
    {
        // GET: Generate
        public ActionResult Index()
        {
            return View();
        }
        public string GetDocument()
        {
            int documentId = int.Parse(Request.Params["documentId"]);
            DAL dal = new DAL();

            String documentAsString = dal.GetGeneratedDocument(documentId);

            return documentAsString;
        }
    }
}